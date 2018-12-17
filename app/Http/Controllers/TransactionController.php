<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;
use App\Post;
use App\TransactionDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post_ids = session()->get('id', []);
        
        $posts = Post::whereIn('id', $post_ids)->get();

        return view('cart', compact('posts'));
    }
    public function allTransaction(){
        $transactions = Transaction::paginate(5);
        
        return view('transactionHistory', compact('transactions'));
    }

    public function addToCart($id) {
        session()->push('id', $id);
        
        return back();
    }

    public function removeFromCart($id) {
        $post_ids = session()->get('id', []);
        $index = array_search($id, $post_ids);

        session()->pull('id.'.$index);

        return back();
    }

    public function checkout() {
        $post_ids = session()->get('id', []);

        $transaction = new Transaction();
        $transaction->transaction_date = Carbon::now();
        $transaction->user_id = Auth::user()->id;
        $transaction->save();

        foreach ($post_ids as $post_id) {
            $detail = new TransactionDetail();
            $detail->transaction_id = $transaction->id;
            $detail->post_id = $post_id;
            $detail->save();
        }

        session()->forget('id');
        return back();
    }

    public function transactionHistory(){
        $transactions = Auth::user()->transactions()->paginate(5);
        
        return view('transactionHistory', compact('transactions'));
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
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
