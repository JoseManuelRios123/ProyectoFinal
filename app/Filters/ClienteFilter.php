<?php

namespace App\Filters;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;
use App\Models\Cliente;
use Illuminate\Database\Eloquent\Builder;

class ClienteFilter extends ApiFilter {

    protected $safeParams = [
        'nombre_cliente' => ['eq'],
        'nit' => ['eq', 'gt', 'gte', 'lt', 'lte'],
        'direccion' => ['eq'],
        'telefono' => ['eq'],
        'actividad_comercial' => ['eq'],
        'Codigo_CIUU' => ['eq', 'gt', 'gte', 'lt', 'lte']
    ];
    protected $columnMap = [
        'Codigo_CIUU'=> 'codigo_ciuu',
    ];
    protected $operatorMap = [
        'eq'=> '=',
        'lt'=> '<',
        'lte'=> '<=',
        'gt'=> '>',
        'gte'=> '>=',
    ];

}