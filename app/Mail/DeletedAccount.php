<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class DeletedAccount extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = $this->user->isCustomer() ? 'Account Registration Denied' : 'ACCESS RIGHTS REMOVED';

        return $this->view('email.deleted_account')->with([
                'user' => $this->user
            ])
            ->from(env('MAIL_USERNAME'), 'Checon Industries')
            ->subject($subject);
    }
}
