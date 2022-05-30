<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MonthlyDonationRemainder extends Mailable {
    use Queueable, SerializesModels;

    public $user;
    public $month;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $month) {
        $this->user = $user;
        $this->month = $month;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        return $this->markdown('admin.mail.monthly-donation-remainder', [
            'user' => $this->user,
            'month' => $this->month
        ]);
    }
}
