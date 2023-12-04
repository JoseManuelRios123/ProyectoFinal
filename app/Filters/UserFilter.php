<?php

namespace App\Filters;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class UserFilter extends ApiFilter {

    protected $safeParams = [
        "Name" => ['eq'],
        "email"=> ['eq'],
        "status"=> ['eq'],

    ];
    protected $columnMap = [
        'Name'=> 'name',
    ];
    protected $operatorMap = [
        'eq'=> '=',
        'lt'=> '<',
        'lte'=> '<=',
        'gt'=> '>',
        'gte'=> '>=',
    ];

}