<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendPdfMail extends Mailable
{
    use Queueable, SerializesModels;
    public $imagesendbymailwithstore;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($imagesendbymailwithstore)
    {
        $this->imagesendbymailwithstore = $imagesendbymailwithstore;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
       
        // return $this->subject($this->object)->markdown('emails.sendpdf');
        return $this->from('info@scmgalaxy.com')
        ->subject('New image from Devops Team')
        ->markdown('emails.sendpdf')
        ->with('data', $this->imagesendbymailwithstore)
        ->attach('./storage/app/public/1662456961.pdf',
            [
                'as' => '1662456961.pdf',
                'mime' => 'application/pdf',
            ]);
      
    }
}