<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class QueryReply extends Mailable
{
    use Queueable, SerializesModels;

    public $user_email;
    public $task_title;
    public $reply;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->user_email = $data['user_email'];
        $this->task_title = $data['task_title'];
        $this->reply      = $data['reply'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.query_reply')
        ->subject('Task Query Reply');
    }
}
