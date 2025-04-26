<?php

namespace App\Services\V1;

use Illuminate\Http\Request;

class CustomerQuesry{

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

    public function transform(Request $request){
        $eloQuery = [];

        foreach($this->allowParms as $parm => $operators){
           $query = $request->query($parm);

           if(!isset($query)){
             continue;
           }

           $column = $this->colimnMap[$parm] ?? $parm;

           foreach($operators as $operator){
                if(isset($query[$operator])){
                    $eloQuery [] = [$column, $this->operatorMap[$operator], $query[$operator]];
                }
           }
        }

        return $eloQuery;
    }
}