<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Blog;
use App\BlogComment;

class BlogCommentsController extends Controller
{
	public function __construct(){
		$this->middleware('auth');
	}
	
	/* 
	 * add a new comment, then redirect back to page
	 */
    public function store(Request $request){
		$input['user_id'] = $request->user()->id;
		$input['blog_id'] = $request->input('blog_id');
		$input['body'] = $request->input('body');
		
		$slug = $request->input('slug');
		
		BlogComment::create($input);
		
		flash()->success('Your comment has been posted.');
		
		return redirect('/blog/' . $slug);
	}
}
