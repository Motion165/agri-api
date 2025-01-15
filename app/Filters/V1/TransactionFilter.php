<?php

namespace App\Filters\V1;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class TransactionFilter extends ApiFilter
{
    protected $safeParams = [
        'farmer_id' => ['eq'],
        'amount' => ['eq', 'lt', 'gt', 'lte', 'gte'],
        'type' => ['eq'],
        'status' => ['eq'],
        'description' => ['eq']
    ];

    protected $columnMap = [
        'farmer_id' => 'farmer_id',
        'amount' => 'amount',
        'type' => 'type',
        'status' => 'status'
    ];

    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '≤',
        'gt' => '>',
        'gte' => '≥',
        'ne' => '!='
    ];
}