<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;  // Note: singular 'Transaction', not 'Transactions'

class TransactionsController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('farmer')->get();  // Use 'Transaction' instead of 'Transactions'
        
        return response()->json([
            'success' => true,
            'data' => $transactions
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'farmer_id' => 'required|exists:farmers,id',
            'amount' => 'required|numeric',
            'type' => 'required|string',
            'status' => 'string',
            'description' => 'nullable|string'
        ]);

        $transaction = Transaction::create($validated);

        return response()->json([
            'success' => true,
            'data' => $transaction
        ], 201);
    }

    public function show(Transaction $transaction)
    {
        return response()->json([
            'success' => true,
            'data' => $transaction->load('farmer')
        ]);
    }

    public function update(Request $request, Transaction $transaction)
    {
        $validated = $request->validate([
            'farmer_id' => 'exists:farmers,id',
            'amount' => 'numeric',
            'type' => 'string',
            'status' => 'string',
            'description' => 'nullable|string'
        ]);

        $transaction->update($validated);

        return response()->json([
            'success' => true,
            'data' => $transaction
        ]);
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return response()->json([
            'success' => true,
            'message' => 'Transaction deleted successfully'
        ]);
    }
}