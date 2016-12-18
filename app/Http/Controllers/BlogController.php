<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;
use App\Tag;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\BlogRequest;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Cache;

class BlogController extends Controller
{
	public function __construct(){
 		$this->middleware('admin')->except(['index', 'show', 'tags']);
	}
	
    public function index(){
    	// get blogs from DB or cache. If user is admin get from DB, else cache them for an hour    		
		$blogs = Blog::getAll(isUserAdmin());
    	
    	// get links for archive
    	$links = Blog::blogLinks();
    	// set page title
    	$title = 'Blog';

		return view('blog/blog', compact('blogs', 'links', 'title'));	
	}
	
	/**
	 * Display a blog post from the DB, specified by $slug
	 * @param string $slug
	 * @return view or redirect
	 */
	public function show($slug){		
		// only allow admin to get non-published blogs
		if(isUserAdmin())
			$blog = Blog::where('slug', $slug)->first();
		else 
			$blog = Blog::where('slug', $slug)->published()->first();
		
		// if no results returned redirect to main page
		if(!$blog)
			return redirect('/blog');
				
		$links = Blog::blogLinks();
		$comments = $blog->comments;
		$title = $blog->title;
		
		return view('blog.show', compact('blog', 'links', 'comments', 'title'));
	}
	
	/**
	 * Display blank form to add a new blog post
	 * @return view
	 */
	public function create(){
		// initialize a blog object to pass to the form, set it to published so we have a default value
		$blog = new Blog();
		$blog->published = 1;
		
		// get the tags and set the tagArray to null
		$tags = \App\Tag::pluck('name', 'id');
		$tagArray = null;
		
		return view('blog.create', compact('blog', 'tags', 'tagArray'));
	}
	
	/**
	 * Add a blog to the DB, specified in form data in request
	 * @param BlogRequest $request
	 * @return redirect
	 */
	public function store(BlogRequest $request){		
 		$blog = $this->createBlog($request);
		
 		// update the latest posts list in redis
 		$this->updateLatestPosts();
 		
 		flash()->success('Your blog has been created');
		
		return redirect('blog');
	}
	
	/**
	 * Display edit form of a blog
	 * @param Blog $id
	 * @return view of edit form
	 */
	public function edit($id){
		$blog = Blog::findOrFail($id);
		
		// tags = allow tags; tagArray = tags that apply to this blog, to populate select
		$tags = \App\Tag::pluck('name', 'id');
		$tagArray = $blog->tags()->pluck('id')->toArray();
		
		return view('blog.edit', compact('blog', 'tags', 'tagArray'));
	}
	
	/**
	 * Update a blog in the DB
	 * 
	 * @param Blog $id
	 * @param BlogRequest $request
	 * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
	 */
	public function update($id, BlogRequest $request){
		// get the blog, update it
		$blog = Blog::findOrFail($id);	
		$blog->update($request->all());
		
		// make sure the slug is valid
		$slug = str_slug($request->input('slug'));
		$blog->slug = $slug;
		
		$blog->save();
		
		// sync the tags
		if($request->input('tags'))
			$this->syncTags($blog, $request->input('tags'));
	
		$this->updateLatestPosts();	
			
		flash()->success('Your blog post has been edited!');	
		return redirect('blog/' . $blog->slug);
	}
	
	/** 
	 * show all posts with a specified tag, returns the blog view
	 * @param string $name of Tag
	 * @return view
	 **/
	public function tags($name){
		$tag = \App\Tag::where('name', $name)->first();
			
		if(!$tag)
			return redirect('/blog');
	
		// only admin can see non-published blogs
		if(isUserAdmin())
			$blogs = $tag->blogs()->latest('published_at')->paginate(15);
		else
			$blogs = $tag->blogs()->latest('published_at')->published()->paginate(5);
				 
		$links = Blog::blogLinks();
		
		return view('blog/blog', compact('blogs', 'links', 'name'));
	}
	
	/**
	 * Delete a blog from the DB
	 * @param int $id
	 * @return redirect
	 */
	public function destroy($id){
		// delete the blog from the DB
		Blog::destroy($id);
		
		// update the redis list
		$this->updateLatestPosts();
		
		return redirect('blog');
	}
	
	/** 
	 * recursively check slug to make sure it is unique. If not keep appending '-1' to it until it is.
	 * Would be better to change -1 to -2, etc. but not that important
	 **/
	private function checkSlug($slug){
		if(Blog::where('slug', $slug)->exists()){
			return $this->checkSlug($slug . '-1');
		} else
			return $slug;
	}
	
	/** 
	 * this creates the blog and returns it.
	 * I don't remember why I separated this from the store function, since it's not called from anywhere else
	 **/
	private function createBlog(Request $request){
		// create a blog from the form data
		$blog = Auth::user()->blogs()->create($request->all());
	
		// 	slugify the slug string
		$slug = str_slug($request->input('slug'));
		// make sure the slug is unique
		$slug = $this->checkSlug($slug);
		$blog->slug = $slug;
		
		// this shouldn't need to be here, but for some reason it defaults published at to today instead of to value from form
		$blog->published_at = $request->input('published_at');
		$blog->save();
		
		// sync tags
		if($request->input('tags'))
			$this->syncTags($blog, $request->input('tags'));
		
		return $blog;
	}
	
	/**
	 * take in tags from drop-down form, check if they exist in DB. if not add them
	 * then update DB with array of tags - all of which are now in DB
	 */
	private function syncTags(Blog $blog, array $tags) {
		$tagArray = [];
		foreach($tags as $tag){
			$tagId = Tag::where('id', $tag)->first();
			if($tagId){
				$tagArray[] = $tag;
			}
			else {
				$newTag = new Tag();
				$newTag->name = $tag;
				$newTag->save();
				$tagArray[] = $newTag->id;
			}
		}
		$blog->tags()->sync($tagArray);
	}
	
	/**
	 * update the list in redis that stores the latest posts. I tried to do this using a Redis list, but it's easier
	 * to just store the entire query in Redis
	 */
	private function updateLatestPosts(){
		$blogs = Blog::published()->orderBy('published_at', 'desc')->orderBy('id', 'desc')->limit(10)->get()->toArray();
		$serialized = json_encode($blogs);
		
		Cache::put('blog:latestposts', $serialized, 1440);	
// 		Redis::set('blog:latestposts', $serialized);
		
		return true;
	}
	
}
