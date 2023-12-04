<?php

namespace App\Filters;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class ProyectoFilter extends ApiFilter {

    protected $safeParams = [
        'idClientes' => ['eq'],
        'idAsesores' => ['eq'],
        'Nombre' => ['eq'],
        'Riesgos' => ['eq', 'gt', 'gte', 'lt', 'lte']
    ];
    protected $columnMap = [
        'Riesgos'=> 'Riesgo',
    ];
    protected $operatorMap = [
        'eq'=> '=',
        'lt'=> '<',
        'lte'=> '<=',
        'gt'=> '>',
        'gte'=> '>=',
    ];

}