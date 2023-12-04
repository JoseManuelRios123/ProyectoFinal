<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
	protected $table = 'clientes';
	protected $primaryKey = 'id_cliente';
	public $timestamps = false;

	protected $fillable = [
		'nombre_cliente',
		'nit',
		'direccion',
		'telefono',
		'actividad_comercial',
		'codigo_ciuu'
	];

	public function proyectos()
	{
		return $this->hasMany(Proyecto::class, 'idClientes');
	}
}
