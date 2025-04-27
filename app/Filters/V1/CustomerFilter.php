<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;
use Illuminate\Http\Request;

class CustomerFilter extends ApiFilter{

    protected $allowParms = [
        'name' => ['eq'],
        'type' => ['eq'],
        'email' => ['eq'],
        'city' => ['eq'],
        'address' => ['eq'],
        'state' => ['eq'],
        'postalCode' => ['eq', 'gt', 'lt']
    ];

    protected $colimnMap = [
        'postalCode' => 'postal_code',
    ];

    protected $operatorMap =[
        'eq' => '=',
        'lt' => '<',
        'gt' => '>',
        'lte' => '<=',
        'gte' => '>='
    ];

}