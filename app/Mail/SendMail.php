<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var string
     */
    private $event;
    /**
     * @var object
     */
    private $data;

    /**
     * Create a new message instance.
     *
     * @param string $event
     * @param object $data
     */
    public function __construct(string $event, object $data)
    {
        $this->event = $event;
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.toAdmin.newReview')->subject('Новый отзыв')->with(['review'=>$this->data]);
    }
}
