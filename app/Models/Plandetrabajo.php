<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Plandetrabajo extends Model
{
	protected $table = 'plandetrabajo';
	protected $primaryKey = 'id_pdt';
	public $timestamps = false;

	protected $casts = [
		'id_proyecto' => 'int',
		'id_Asesor' => 'int',
		'fecha_inicio' => 'datetime',
		'fecha_fin' => 'datetime'
	];

	protected $fillable = [
		'id_proyecto',
		'id_Asesor',
		'nombre_actividad',
		'fecha_inicio',
		'fecha_fin'
	];

	public function asesore()
	{
		return $this->belongsTo(Asesore::class, 'id_Asesor');
	}

	public function proyecto()
	{
		return $this->belongsTo(Proyecto::class, 'id_proyecto');
	}
}
