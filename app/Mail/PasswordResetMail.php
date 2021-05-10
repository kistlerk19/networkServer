<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordResetMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $passwordResetData;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($passwordResetData)
    {
        $this->passwordResetData = $passwordResetData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $url = url('api/users/forgot_password/'.$this->passwordResetData->token);
        return $this->from('leom7730@gmail.com')->markdown('emails.auth.password-reset', [
            'email' => $this->passwordResetData->email,
            'url' => $url,
            // 'username' => $this->user->username,
        ]);
    }
}
