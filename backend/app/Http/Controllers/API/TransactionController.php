<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('product')->latest()->paginate(10);
        if(!$transactions){
            return response()->json(['status' => 404,'data' => null]);
        } else {
            return response()->json(['status' => 200,'data' => $transactions]);
        }
    }
    public function show($id)
    {
        $transaction = Transaction::with('product')->findOrFail($id);
        return response()->json(['status' => 200,'data'=> $transaction]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'productId' => 'required',
            'referenceNo' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
        ]);
        $paymentAmount = (int)$request->price * (int)$request->quantity;
        $transaction = Transaction::create([
            'product_id' => $request->productId,
            'reference_no' => $request->referenceNo,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'payment_amount' => $paymentAmount
        ]);
        return response()->json(['status' => 200,'data' => $transaction]);
    }
    public function update(Request $request,$id)
    {
        $request->validate([
            'productId' => 'required',
            'referenceNo' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
        ]);
        $paymentAmount = (int)$request->price * (int)$request->quantity;
        $transaction = Transaction::findOrFail($id);
        $transaction->update([
            'product_id' => $request->productId,
            'reference_no' => $request->referenceNo,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'payment_amount' => $paymentAmount
        ]);
        return response()->json(['status' => 200,'data' => $transaction]);
    }
    public function destroy($id)
    {
        Transaction::findOrFail($id)->delete();
        return response()->json(['status' => 200,'message' => 'deleted']);
    }
}
