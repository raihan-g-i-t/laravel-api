<?php

namespace App\Filters\V1;

use App\Filters\ApiFilter;

class InvoiceFilter extends ApiFilter{

    protected $allowParms = [
        'amount' => ['eq', 'gt', 'lt', 'gte', 'lte'],
        'status' => ['eq', 'ne'],
        'billedDate' => ['eq', 'gt', 'lt', 'gte', 'lte'],
        'paidDate' => ['eq', 'gt', 'lt', 'gte', 'lte'],
        'customerId' => ['eq'],
    ];

    protected $colimnMap = [
        'billedDate' => 'billed_date',
        'paidDate' => 'paid_date',
        'customerId' => 'customer_id'
    ];

    protected $operatorMap =[
        'eq' => '=',
        'lt' => '<',
        'gt' => '>',
        'lte' => '<=',
        'gte' => '>=',
        'ne' => '!='
    ];

}