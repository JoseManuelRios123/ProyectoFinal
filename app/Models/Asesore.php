<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Asesore extends Model
{
	protected $table = 'asesores';
	protected $primaryKey = 'id_asesor';
	public $timestamps = false;

	protected $fillable = [
		'nombre_asesor',
		'profesion_asesor',
		'licencia_asesor'
	];

	public function plandetrabajos()
	{
		return $this->hasMany(Plandetrabajo::class, 'id_Asesor');
	}

	public function proyectos()
	{
		return $this->hasMany(Proyecto::class, 'idAsesores');
	}
}
