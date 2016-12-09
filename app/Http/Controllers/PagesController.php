<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Cache;
// use Illuminate\Support\Facades\View;
use Mail;
use App\Mail\ContactEmail;
use App\Job;
use App\Http\Requests;

class PagesController extends Controller
{
	/**
	 * Displays the about me page
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
    public function about(){
    	$title = 'About Me';
    	return view ('pages.about', compact('title'));
    	/* $cache = cache('about');
    	 if($cache){
    		return $cache;
    	} else {
    		$view = (string) View::make('pages.about', compact('title'));
    		return putInCache('about', $view, 360);
    	} */
	}
	
	/**
	 * Displays the cv page
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function cv(){
		$jobs = Job::orderBy('order', 'asc')->get();
		$title = 'My CV';
		return view('pages.cv', compact('jobs', 'title'));
		
		/* $page = cache('about.cv');
		if($page != null){
			return $page;
		} else {
			$view = View::make('pages.cv', compact('jobs', 'title'));
			Cache::put('about.cv', (string) $view, 360);
			
		} */
	}
	
	/**
	 * Displays the contact me page
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function contact(){
		$title = 'Contact Me';
		
		return view('pages.contact', compact('title'));
	}
	
	/**
	 * Sends an email from the contact me page
	 * @param Request $request
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function sendEmail(Request $request){
		$this->validate($request, [
			'email' => 'required|email',
			'body' => 'required',
		]);
		
		$message = [
				'name' => $request->name,
				'email' => $request->email,
				'body' => $request->body,
		];
		
		Mail::to('skooch@gmail.com')->send(new ContactEmail($message));
		
		return view('pages.contactSuccess');
	}
	
	/**
	 * Displays the projects page
	 * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
	 */
	public function projects(){
		$title = 'Projects';
		return view('pages.projects', compact('title'));
	}
	
}
