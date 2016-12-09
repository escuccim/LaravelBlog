<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use App\Http\Requests;

class ContactEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $messageContent;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($message)
    {
        $this->messageContent = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
    	return $this
//     				->from($this->messageContent['email'])
        			->from('WebSiteMails@skoo.ch')
    				->view('email.contact');
    }
}
