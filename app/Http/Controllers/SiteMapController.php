<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;
use App\Tag;

class SiteMapController extends Controller
{
    public function index(){
		$blog = Blog::latest('published_at')->published()->first();
		
		return response()->view('sitemap.sitemap', compact('blog'))->header('Content-Type', 'text/xml');
    }
	
   public function blog(){
   		$blogs = Blog::latest('published_at')->orderBy('id', 'desc')->published()->get();
   		return response()->view('sitemap.blogs', compact('blogs'))->header('Content-Type', 'text/xml');
   }

	public function labels(){
		$tags = Tag::all();
		return response()->view('sitemap.tags', compact('tags'))->header('Content-Type', 'text/xml');
	}

	public function pages(){
		// set the last modified date to the first of this month
		$lastMod = date("c", strtotime(date("Y-m-01 00:00:00")));
		return response()->view('sitemap.pages', compact('lastMod'))->header('Content-Type', 'text/xml');
	}
}

