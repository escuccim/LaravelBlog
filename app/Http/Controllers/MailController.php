<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Http\Requests;

class MailController extends Controller
{
	/**  
	 * Sends me an email to let me know about new registrations.
	 * I don't remember how most of this works, and I don't think the title and content are ever used, so could probably
	 * be removed.
	 * 
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 **/
    public function sendRegistrationEmail(Request $request){
// 		$title = $request->input('title');
// 		$content = $request->input('content');
		
    	$title = "Test Email with Subject";
    	$content = "Body content";
    	
		Mail::send('email.send', ['title' => $title, 'content' => $content], function($message){
			$message->from('skooch@gmail.com', 'Eric S');
			$message->to('eric@skoo.ch');
			$message->subject('New Registration');
		});
		
		return response()->json(['message' => 'Request completed']);
	}
}
