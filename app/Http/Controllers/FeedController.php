<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;

class FeedController extends Controller
{
    public function generate(){
		$blogs = Blog::latest('published_at')->orderBy('id', 'desc')->published()->take(10)->get();
		
		$feed = \App::make('feed');
		$feed->title = 'Eric Scuccimarra\'s Blog';
		$feed->description = 'Eric\'s Blog About Whatever';
		// $feed->logo = asset('img/logo.png'); //optional
		$feed->link = url('feed');
		$feed->setDateFormat('carbon'); // 'datetime', 'timestamp' or 'carbon'
		$feed->pubdate = $blogs[0]->published_at;
		$feed->lang = 'en';
		$feed->setShortening(true); // true or false
		$feed->setTextLimit(100); // maximum length of description text
		
		foreach ($blogs as $blog)
		{
			// set item's title, author, url, pubdate, description and content
			$feed->add($blog->title, 'Author', url('blog/' . $blog->slug), $blog->published_at, $blog->body, $blog->body);
		}
		
		return $feed->render('rss'); // or atom
	}
}
