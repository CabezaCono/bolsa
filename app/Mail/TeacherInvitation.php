<?php

namespace App\Mail;

use App\User;
use Clarkeash\Doorman\Facades\Doorman;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;

class TeacherInvitation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $doorman;

    public function __construct($doorman)
    {
        $this->doorman=$doorman;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('Mails.TeacherInvitation');
    }
}