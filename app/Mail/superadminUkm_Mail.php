<?php

namespace App\Mail;

use App\Model\Superadmin_ukm\U_user_ukm;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class superadminUkm_Mail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    protected $user;
    public function __construct(U_user_ukm $u_user_ukm)
    {
        //
        $this->user = $u_user_ukm;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->user->email, $this->user->nama)
            ->subject('Selamat anda telah melakukan registrasi!')
            ->view('email.email_verification')
            ->with('user', $this->user);
    }
}
