<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmailDemo extends Mailable
{
    use Queueable, SerializesModels;
    protected $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        //
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Nifticals Product Query Mail')
                    ->from('test@elevatedadvice.com')
                    ->view('email.testemail')
                    ->with("details",$this->data)
                    ->attach($this->data['mail_image']->getRealPath(), [
                        'as' => $this->data['mail_image']->getClientOriginalName()
                    ]);
    }
}
