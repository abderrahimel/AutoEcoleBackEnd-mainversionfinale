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
    public $message;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($imagesendbymailwithstore)
    {
        $this->imagesendbymailwithstore = $imagesendbymailwithstore;
        $this->message = $this->imagesendbymailwithstore['message'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
       
        // return $this->subject($this->object)->markdown('emails.sendpdf');
        return $this->from('jhb.plus@yahoo.com')
        ->subject($this->imagesendbymailwithstore['object'])
        ->markdown('emails.sendpdf')
        ->with('data', $this->imagesendbymailwithstore)
        // ->attach('./storage/app/public/1668510840.pdf',
        ->attach('./storage/'.$this->imagesendbymailwithstore['fichier'],
            [
                'as' => $this->imagesendbymailwithstore['fichier'],
                'mime' => 'application/pdf',
            ]);
      
    }
}