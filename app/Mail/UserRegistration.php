<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserRegistration extends Mailable {
    use Queueable, SerializesModels;

    public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user_details) {
        $this->user = $user_details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        rh_log($this->user['email'], 'Member Reg Email', 'Sent');
        return $this->markdown('admin.mail.user-registration', [
            'user' => $this->user
        ]);
    }
}
