<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
use Session,Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public static function CheckBidSubmit($project_id)
    {
        $user_id = Auth::user()->id;
        date_default_timezone_set("Asia/Dhaka");

        $project_info = DB::table('projects')
                ->where('id',$project_id)
                ->first();

        if( $project_info->user_id == $user_id) {
            redirect()->back()->with('error', 'You are not allowed to bid in this project!');
            return false;
        }        
            
        $project_name = $project_info->title;


        $free_bid_per_month = DB::table('settings')
            ->where('title_key','free_bid_per_month')
            ->first();

        if(isset($free_bid_per_month->value) && $free_bid_per_month->value) {
            $free_bid_per_month = (int)$free_bid_per_month->value;
        } else {
            $free_bid_per_month = 0;
        }

        $per_bid_cost = DB::table('settings')
            ->where('title_key','per_bid_cost')
            ->first();
            
        if(isset($per_bid_cost->value) && $per_bid_cost->value) {
            $per_bid_cost = (int)$per_bid_cost->value;
        } else {
            $per_bid_cost = 50;
        }

        $start_date = date("Y-m-01 00:00:00");
        $end_date = date("Y-m-d H:i:s");
        //DB::enableQueryLog();
        
        $total_bids = DB::table('bids')
            ->select(DB::raw('COUNT(id) as t_bids'))
            ->where('user_id', $user_id)
            //->where('created_at','>=',$start_date)
            //->where('created_at','<=', $end_date)
            ->whereBetween('created_at', [$start_date, $end_date])
            ->first();
        if(isset($total_bids->t_bids) && $total_bids->t_bids!='')
        {
            $total_bids_count = $total_bids->t_bids;
        } else {
            $total_bids_count = 0;
        } 

        if( $total_bids_count >= $free_bid_per_month )
        {

            $user_balance = DB::table('remittance')
                ->select(DB::raw('(SUM(`credit_amount`)-SUM(`debit_amount`)) as balance'))
                ->where('user_id', $user_id)
                ->first();
            if(isset($user_balance->balance) && $user_balance->balance!='')
            {
                $user_balance = $user_balance->balance;
            } else {
                $user_balance = 0;
            } 


            if($user_balance >= $per_bid_cost )
            {
                $transactions_data = array(
                    'transaction_id' =>  $project_id,
                    'user_id' => $user_id,
                    'remarks' => $project_name,
                    'particulars' => 'Bid Cost',
                    'narration' => 'Bid Cost',
                    'amount' => $per_bid_cost,
                    'status' => '1',
                    'txn_date'=>date("Y-m-d")        
                    );
                $transaction_id = DB::table('transactions')->insertGetId($transactions_data); 
                
                $remittance_data = array(
                    'vch_type' => 'Payment',
                    'vch_no' =>  $transaction_id,
                    'transaction_id' =>  $transaction_id,
                    'user_id' => $user_id,
                    'debit_amount' => $per_bid_cost,
                    'remarks' => $project_name,
                    'particulars' => 'Bid charge',
                    'narration' => 'Bid charge',
                    'status' => '1',
                    'txn_date'=>date("Y-m-d")        
                    );
                DB::table('remittance')->insert($remittance_data);

            } else {
                redirect()->back()->with('error', 'You balance is lower to bid this project!');
                return false;
            }

        }

            
        //dd(DB::getQueryLog());    
        //dd($total_bids);

        $bid_info = DB::table('bids')
            ->where('user_id',$user_id)
            ->where('project_id',$project_id)
            ->first();

        if(isset($bid_info->id) && $bid_info->id!='') {
            redirect()->back()->with('error', 'You have already submitted your bid in this project!');
            return false;
        } else {
            return true;
        }
   
    }


    public static function GetCurrentBalance()
    {
        $user_id = Auth::user()->id;
        date_default_timezone_set("Asia/Dhaka");

        $user_balance = DB::table('remittance')
            ->select(DB::raw('(SUM(`credit_amount`)-SUM(`debit_amount`)) as balance'))
            ->where('user_id', $user_id)
            ->first();
        if(isset($user_balance->balance) && $user_balance->balance!='')
        {
            $user_balance = $user_balance->balance;
        } else {
            $user_balance = 0;
        } 

        return $user_balance;
    } 


    public static function SendNotification($notification_content)
    {
        $data = array(
            'user_id'  => $notification_content['user_id'],
            'notification_text'  => $notification_content['notification_text'],
            'action_url'  => $notification_content['action_url'],
            'status'  => 0
        );
        DB::table('notifications')->insert($data);
    } 

    public static function PrintBidInfo($content,$permission)
    {
        if($permission==1){
            return $content;
        } else {
            $string = '';
            $content_array = str_split($content);  //print_r($content_array); exit;
            foreach ($content_array as $key => $value)           
            {
                if($value == ' ') $string .= ' '; else $string .= '*';
                
            }
            return $string;
        }        
    }

    public static function MakeSeoTitle($title,$id)
    {        
        $seo_title = strtolower(str_replace([' ','/','&'], "-", $title)).'-'.$id;    
        return $seo_title;              
    }

    public static function ChargeSecurityDeposit($project_id)
    {        
        $user_id = Auth::user()->id;
        $project_info = DB::table('projects')
            ->select('projects.*',DB::raw('(SELECT `security_deposit_employer` FROM `charges` WHERE `id`=`projects`.`charge_id`) as `d_charge`'))
            ->where('id', $project_id)
            ->first();
        //dd($project_info);

        $data = [];    
            
        $charge_amount = 0;    
        if(isset($project_info->d_charge) && $project_info->d_charge !='')
        {
            if(strstr($project_info->d_charge, '%'))
            {
                $project_total_amount = ($project_info->min_budget+$project_info->max_budget)/2; 
                $charge_percentage = (int)str_replace('%', '', $project_info->d_charge); 
                $charge_amount = ($project_total_amount*$charge_percentage)/100;
            } else {
                $charge_amount = $project_info->d_charge; 
            }
            $data['charge_amount'] = $charge_amount;

            $project_name = $project_info->title; 
        }

        $user_balance = DB::table('remittance')
            ->select(DB::raw('(SUM(`credit_amount`)-SUM(`debit_amount`)) as balance'))
            ->where('user_id', $user_id)
            ->first();
        if(isset($user_balance->balance) && $user_balance->balance!='')
        {
            $current_balance = $user_balance->balance;
        } else {
            $current_balance = 0;
        }    
  
        if($charge_amount>0 && $current_balance> $charge_amount && $project_info->status == 0)
        {            
            $transactions_data = array(
                    'transaction_id' =>  $project_id,
                    'user_id' => $user_id,
                    'remarks' => $project_name,
                    'particulars' => 'Security Deposit',
                    'narration' => 'Security Deposit',
                    'amount' => $charge_amount,
                    'status' => '1',
                    'txn_date'=>date("Y-m-d")        
                    );
            $transaction_id = DB::table('transactions')->insertGetId($transactions_data); 
            
            $remittance_data = array(
                'vch_type' => 'Payment',
                'vch_no' =>  $transaction_id,
                'transaction_id' =>  $transaction_id,
                'user_id' => $user_id,
                'debit_amount' => $charge_amount,
                'remarks' => $project_name,
                'particulars' => 'Security Deposit',
                'narration' => 'Security Deposit',
                'status' => '1',
                'txn_date'=>date("Y-m-d")        
                );
            DB::table('remittance')->insert($remittance_data);

            DB::table('projects')
                  ->where('id', $project_id)
                  ->update(['security_deposit'=>$charge_amount]);

            $data['status'] = 'deposited';
        } else {
            $data['status'] = 'fail';
        }

        return $data;          
    }
    
}
