<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;  // Note: singular 'Transaction', not 'Transactions'
use App\Filters\V1\TransactionFilter;
use App\Http\Resources\V1\TransactionCollection;

class TransactionsController extends Controller
{
    public function index(Request $request)
    {
        $filter = new TransactionFilter();
        $queryItems = $filter->transform($request); // [['column', 'operator', 'value']]

        if (count($queryItems) == 0) {
            return new TransactionCollection(Transaction::paginate());
        } else {
            $transactions = Transaction::where($queryItems)->paginate();
            return new TransactionCollection($transactions->appends($request->query()));
        }
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