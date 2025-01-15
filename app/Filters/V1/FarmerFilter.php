<?php

namespace App\Filters\V1;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class FarmerFilter extends ApiFilter
{
    protected $safeParams = [
        'name' => ['eq'],
        'phone' => ['eq'],
        'email' => ['eq'],
        'location' => ['eq'],
        'farm_size' => ['eq', 'gt', 'lt'],
        'crop_type' => ['eq'],
        'registration_date' => ['eq', 'gt', 'lt']
    ];

    protected $columnMap = [
        'farmSize' => 'farm_size',
        'cropType' => 'crop_type',
        'registrationDate' => 'registration_date'
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