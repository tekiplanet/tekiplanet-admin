<?php

namespace App\Mail;

use App\Models\Hustle;
use App\Models\User;
use App\Models\HustleMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewHustleMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $hustle;
    public $recipient;
    public $message;

    public function __construct(Hustle $hustle, User $recipient, HustleMessage $message)
    {
        $this->hustle = $hustle;
        $this->recipient = $recipient;
        $this->message = $message;
    }

    public function build()
    {
        return $this->subject("New Message: {$this->hustle->title}")
                    ->view('emails.messages.new-message');
    }
} 