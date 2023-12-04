<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
	protected $table = 'proyectos';
	protected $primaryKey = 'idProyecto';
	public $timestamps = false;

	protected $casts = [
		'idClientes' => 'int',
		'idAsesores' => 'int',
		'Riesgo' => 'int'
	];

	protected $fillable = [
		'idClientes',
		'idAsesores',
		'Nombre',
		'Riesgo'
	];

	public function cliente()
	{
		return $this->belongsTo(Cliente::class, 'idClientes');
	}

	public function asesore()
	{
		return $this->belongsTo(Asesore::class, 'idAsesores');
	}
	
	
	public function plandetrabajos()
	{
		return $this->hasMany(Plandetrabajo::class, 'id_proyecto');
	}
	public function carpetas()
	{
		return $this->hasMany(Carpeta::class, 'id_Proyecto');
	}

	public function hacerArchivos()
    {
    return $this->hasManyThrough(Archivo::class, Carpeta::class, 'id_Proyecto', 'carpeta_id')
        ->where('carpetas.nombre', 'hacer');
    }

    public function planearArchivos()
    {
        return $this->hasManyThrough(Archivo::class, Carpeta::class, 'id_Proyecto', 'carpeta_id')
            ->where('carpetas.nombre', 'Planear');
    }

    public function verificarArchivos()
    {
        return $this->hasManyThrough(Archivo::class, Carpeta::class, 'id_Proyecto', 'carpeta_id')
            ->where('carpetas.nombre', 'verificar');
    }

    public function actuarArchivos()
    {
        return $this->hasManyThrough(Archivo::class, Carpeta::class, 'id_Proyecto', 'carpeta_id')
            ->where('carpetas.nombre', 'actuar');
    }
}
