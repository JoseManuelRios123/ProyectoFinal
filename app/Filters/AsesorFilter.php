<?php

namespace App\Filters;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class AsesorFilter extends ApiFilter {

    protected $safeParams = [
        'nombre_asesor' => ['eq'],
        'profesion_asesor' => ['eq'],
        'licenciaAsesor' => ['eq', 'gt', 'gte', 'lt', 'lte']
    ];
    protected $columnMap = [
        'licenciaAsesor' => 'licencia_asesor',
    ];
    protected $operatorMap = [
        'eq'=> '=',
        'lt'=> '<',
        'lte'=> '<=',
        'gt'=> '>',
        'gte'=> '>=',
    ];

}