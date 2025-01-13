<?php

namespace App\Filters\V1;

use Illuminate\Http\Request;
use App\Filters\AppFilter;

class FarmerFilter extends ApiFilter{
    protected $safeParams = [
        'name' => ['eq'],
        'phone' => ['eq'],
        'email' => ['eq'],
        'location' => ['eq'],
        'farm_size' => ['eq', 'gt', 'lt'],
        'crop_type' => ['eq'],
        'registration_date' => ['eq', 'gt', 'lt'],
        'status' => ['eq']
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
    ];

    public function transform(Request $request)
    {
        $eloQuery = [];

        foreach ($this->safeParams as $parm => $operators) {
            $query = $request->query($parm);

            if (!isset($query)) {
                continue;
            }

            $column = $this->columnMap[$parm] ?? $parm;

            foreach ($operators as $operator) {
                if (isset($query[$operator])) {
                    $eloQuery[] = [$column, $this->operatorMap[$operator], $query[$operator]];
                }
            }
        }

        return $eloQuery;
    }
}