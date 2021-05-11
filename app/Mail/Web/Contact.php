<?php

namespace App\Mail\Web;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Contact extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->replyTo($this->data['replay_email'],$this->data['replay_name'])->to(getenv('MAIL_FROM_ADDRESS'), getenv('MAIL_FROM_NAME'))
            ->from(getenv('MAIL_FROM_ADDRESS'), getenv('MAIL_FROM_NAME'))->subject('teste')->markdown('emails.contact',[
                'name' =>  $this->data['replay_name'],
                'email' =>  $this->data['replay_email'],
                'phone' =>  $this->data['phone'],
                'message' =>  $this->data['message']
            ]);
    }
}
