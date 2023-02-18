<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTransactionRequest;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $user_id = Auth::id();
        $transactions = Transaction::with('category')->where('user_id', $user_id)->get();
        return response()->json($transactions);
    }

    public function store(StoreTransactionRequest $request)
    {
        $user_id = Auth::id();
        $transaction = Transaction::create([
            'amount' => $request->amount,
            'description' => $request->description,
            'date' => $request->date,
            'user_id' => $user_id,
            'category_id' => $request->category_id,
        ]);

        return response()->json($transaction, 201);
    }

    public function show($id)
    {
        $transaction = Transaction::with('category')->find($id);
        if ($transaction->user_id !== Auth::id())
            return response()->json(['message' => 'Unauthorized'], 403);
     
        return response()->json($transaction);
    }

    public function update(StoreTransactionRequest $request, Transaction $transaction)
    {
        if ($transaction->user_id !== Auth::id())
            return response()->json(['message' => 'Unauthorized'], 403);

        $transaction->update([
            'amount' => $request->amount,
            'description' => $request->description,
            'date' => $request->date,
            'category_id' => $request->category_id,
        ]);

        return response()->json($transaction);
    }

    public function destroy($id)
    {
        $transaction = Transaction::find($id);
        if ($transaction->user_id !== Auth::id())
            return response()->json(['message' => 'Unauthorized'], 403);
     
        $transaction->delete();
        return response('', 204);
    }
}
