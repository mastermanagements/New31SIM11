<?php

namespace App\Mail;

use App\Model\Superadmin_ukm\U_user_ukm;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class emailResetPassword extends Mailable
{
    use Queueable, SerializesModels;
    public $posts;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($post)
    {
        //
        $this->posts= $post;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = "Password baru telah Di Kirim Ke Email anda";
        return $this->subject($subject)->view('email.new_password_verifikasi');
    }
}
