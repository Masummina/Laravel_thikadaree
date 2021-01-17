<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Faker\Provider\DateTime;
use App\User;
use App\Acl;
use App\Transaction;
use DB,Session,Auth;
use Illuminate\Routing\Route;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('admin');
    }


    public function index()
    {
        if (!Auth::check()) { return redirect()->back()->with('msg', 'Please login first!'); }
        $user_id = Auth::user()->id;
        // $transactions = Transaction::orderBy('id','desc')->paginate(10);
        $transactions = DB::table('transactions')
        ->join('users', 'transactions.user_id', '=', 'users.id')
        ->select('transactions.*', 'users.name')
        ->orderBy('id','desc')->paginate(10);


        return view('admin.transaction.index', compact('transactions'));
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Transaction::find($id);
        
        $status = 0;
        if(isset($_GET['status'])){
            $status = $_GET['status'];
            if($status == 1){
                if($data->trans_type == 'withdrawal'){
                    $array = [
                        'vch_type' => 'Payment',
                        'vch_no'   => $data->transaction_id,
                        'debit_amount'   => $data->amount,
                        'particulars'   => $data->particulars,
                        'remarks'   => $data->bank_name,
                        'user_id'   => $data->user_id,
                        'txn_date'   => $data->txn_date,
                        'transaction_id'   => $data->transaction_id,
                        'status'   => 1
                    ];
                }elseif($data->trans_type == 'reveived'){
                    $array = [
                        'vch_type' => 'Receive',
                        'vch_no'   => $data->transaction_id,
                        'credit_amount'   => $data->amount,
                        'particulars'   => $data->particulars,
                        'remarks'   => $data->bank_name,
                        'user_id'   => $data->user_id,
                        'transaction_id'   => $data->transaction_id,
                        'status'   => 1
                    ];
                }
              
                DB::table('remittance')->insert($array);
            }
            $data->status = $status;
            if($data->save()){
                Session::flash('success', 'Status successfully updated!');
                return redirect('bem-transactions');
            }else{
                Session::flash('error', 'Sorry status updated fail!');
                return redirect()->back();
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Transaction::find($id);

        $item->delete();

        return redirect('bem-transaction')->with('success', 'Transaction deleted successfully!');
    }
}
