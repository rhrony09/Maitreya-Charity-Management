<?php

use App\Models\Log;

if (!function_exists('moneyFormatBD')) {
    function moneyFormatBD($num) {
        $explrestunits = '';
        if (strlen($num) > 3) {
            $lastthree = substr($num, strlen($num) - 3, strlen($num));
            $restunits = substr($num, 0, strlen($num) - 3); // extracts the last three digits
            $restunits = strlen($restunits) % 2 == 1 ? '0' . $restunits : $restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
            $expunit = str_split($restunits, 2);
            for ($i = 0; $i < sizeof($expunit); $i++) {
                // creates each of the 2's group and adds a comma to the end
                if ($i == 0) {
                    $explrestunits .= (int) $expunit[$i] . ','; // if is first value , convert into integer
                } else {
                    $explrestunits .= $expunit[$i] . ',';
                }
            }
            $thecash = $explrestunits . $lastthree;
        } else {
            $thecash = $num;
        }
        return $thecash; // writes the final format where $currency is the currency symbol.
    }
}

if (!function_exists('send_sms')) {
    function send_sms($contact, $message) {
        $url = "http://sms.imbdagency.com/smsapi";
        $data = [
            "api_key" => "C2006752628c9b5125d075.16526040",
            "type" => "unicode",
            "contacts" => $contact,
            "senderid" => "41919",
            "msg" => $message,
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
}

if (!function_exists('rh_log')) {
    function rh_log($details, $type, $status) {
        Log::insert([
            'details' => $details,
            'type' => $type,
            'status' => $status,
            'created_at' => now(),
        ]);
    }
}
