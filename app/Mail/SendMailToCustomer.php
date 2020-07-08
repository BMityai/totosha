<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailToCustomer extends Mailable
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
        if ( $this->event == 'review') {
            return $this->sendEmailAboutCreateNewReview();
        }
        if ( $this->event == 'order') {
            return $this->sendEmailAboutCreateNewOrder();
        }
        return null;
    }

    private function sendEmailAboutCreateNewReview()
    {
        return $this->view('mail.toCustomer.newReview')->subject('Новый отзыв')->with(['review'=>$this->data]);
    }

    private function sendEmailAboutCreateNewOrder()
    {
        return $this->view('mail.toCustomer.newOrder')->subject('Информация о заказе')->with(['order'=>$this->data]);
    }
}
