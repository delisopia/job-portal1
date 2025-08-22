<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Application;

class ApplicationStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $application;
    public $status;

    /**
     * Create a new message instance.
     */
    public function __construct(Application $application, $status)
    {
        $this->application = $application;
        $this->status = $status;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Status Lamaran Anda')
                    ->view('emails.application_status');
    }
}
