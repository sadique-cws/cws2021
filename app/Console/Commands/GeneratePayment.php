<?php

namespace App\Console\Commands;

use App\Models\Payments;
use App\Models\User;
use DateTime;
use Illuminate\Console\Command;

class GeneratePayment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:payment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $user = User::where('user_type','student')->get();
        $now = new DateTime();

        foreach($user as $u){

            $dateOfJoin = new DateTime($u->create_at);
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
                    }


                }

            }

        }

    }
}
