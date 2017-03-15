<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AccountCredentials extends Mailable
{
    use Queueable, SerializesModels;

    protected $email, $password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.account_credentials')->with([
            'email' => $this->email,
            'password' => $this->password,
        ])
        ->from(env('MAIL_USERNAME'), 'Checon Industries')
        ->subject('Admin Account Credentials');
    }
}
