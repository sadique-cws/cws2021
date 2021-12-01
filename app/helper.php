<?php

use App\Mail\DuePayments;
use App\Models\Payments;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

if(!function_exists('generate_payment')){
    function generate_payment(){
        $user = User::where('user_type','student')->get();
        $now = new DateTime();

        foreach($user as $u){

            $dateOfJoin = new DateTime($u->created_at);
            $start_year = $dateOfJoin->format('Y');
            $end_year = $now->format('Y');
            for($year=$start_year; $year<=$end_year;$year++){
                if($start_year==$end_year){
                    $start_month = $dateOfJoin->format('m');
                    $end_month = $now->format('m');
                }
                elseif($year==$start_year){
                    $start_month = $dateOfJoin->format('m');
                    $end_month = 12;
                }
                elseif($year==$end_year){
                    $start_month = 01;
                    if($now->format('d')>$dateOfJoin->format('d')){
                        $end_month = $now->format('m');
                    }
                    else{
                        $end_month = $now->format('m')-1;
                    }
                }
                else{
                    $start_month = 01;
                    $end_month = 12;
                }

                for($month=$start_month;$month<=$end_month;$month++){
                    $result = new DateTime($year.'-'.$month.'-'.$dateOfJoin->format('d'));
                    $new_date = $result->format("Y-m-d");
                    $student_id = $u->id;

                    $payment = Payments::where([['student_id',$student_id],['dues_month',$new_date]])->get();

                    if($payment->count() == 0){

                        $new_payment = new Payments();
                        $new_payment->student_id = $student_id;
                        $new_payment->amount = 700;
                        $new_payment->dues_month = $new_date;
                        $new_payment->save();

                        // send sms
                        $due_month = $result->format('M');
                        $phone = $u->contact;

                        $data = [
                            'name' => $u->name,
                            // 'email' => $email,
                            'due_month' => $due_month,
                            'due_amount' => 700,
                        ];


                        send($phone,'Your ₹ 700 amount is Dues for '.$due_month.' month, please pay your Dues ASAP');
                    }


                }

            }

        }
    }
}

if(!function_exists('send')){
    function send($to, $message){
        $sender_id = "CWSTXT";
        $auth_key = "255108AsWkIhuXpb5c3026c8";
        $message = urlencode($message);
        $route = "4";
        $postData = '{
            "sender": "'.$sender_id.'",
            "route": "'.$route.'",
            "country": "91",
            "sms": [
                {
                    "message": "'.$message.'",
                    "to": [
                        "'.$to.'"
                    ]
                }
            ]
        }';

            //API URL
            $url="http://api.msg91.com/api/v2/sendsms";

            // init the resource
            $ch = curl_init();
            curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",

            // CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $postData,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_HTTPHEADER => array(
                "authkey: $auth_key",
                "content-type: application/json"),
            ));

            //get response
            $response = curl_exec($ch);
            $err = curl_error($ch);

            curl_close($ch);

            if ($err) {
            echo "cURL Error #:" . $err;
            }
            else{
                $result = json_decode($response);

                if ($result->type === "success"){
                    return TRUE;
                }
                else{
                    return FALSE;
                }
            }

            // return 1;
    }
}

if(!function_exists('payments')){
    function payments($status = null){
        if($status !== null){
            $payment = Payments::where('status',$status)->get();
        }
        else{
            $payment = Payments::get();
        }

        return $payment;
    }
}

?>
