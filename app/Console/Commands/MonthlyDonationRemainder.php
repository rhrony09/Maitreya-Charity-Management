<?php

namespace App\Console\Commands;

use App\Mail\MonthlyDonationRemainder as MailMonthlyDonationRemainder;
use App\Models\Funds;
use App\Models\Log;
use App\Models\Month;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class MonthlyDonationRemainder extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'monthly:remainder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send monthly donation reminder to all users';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle() {
        $users = User::where('status', 1)->get();
        foreach ($users as $user) {
            if (Funds::where('user_id', $user->id)->where('year', date('Y'))->where('month', date('n'))->doesntExist()) {
                $month = Month::find(date('n'))->name . ' ' . date('Y');
                $en_month_list = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                $bn_month_list = ['জানুয়ারি', 'ফেব্রুয়ারি', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'অগাস্ট', 'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর'];
                $en_number = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
                $bn_number = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
                $bangla_date = str_replace($en_number, $bn_number, str_replace($en_month_list, $bn_month_list, $month));
                $message = $bangla_date . ' এর মাসিক ডোনেশন অনুগ্রহ করে প্রদান করুন।

টিম মৈত্রেয়';
                //send mail
                if (!empty($user->email)) {
                    Mail::to($user->email)->queue(new MailMonthlyDonationRemainder($user, $month));
                }
                //send sms
                if (send_sms($user->contact, $message)) {
                    rh_log($user->contact, 'Remainder SMS', 'Sent');
                } else {
                    rh_log($user->contact, 'Remainder SMS', 'Failed');
                }
                sleep(1);
            }
        }
        return 0;
    }
}
