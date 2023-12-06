<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Archivo
 * 
 * @property int $id_archivo
 * @property string $nombre
 * @property string $ruta
 * @property int $carpeta_id
 * @property int $IDPDT
 * 
 * @property Plandetrabajo $plandetrabajo
 * @property Carpeta $carpeta
 *
 * @package App\Models
 */
class Archivo extends Model
{
	protected $table = 'archivos';
	protected $primaryKey = 'id_archivo';
	public $timestamps = false;

	protected $casts = [
		'carpeta_id' => 'int',
		'IDPDT' => 'int'
	];

	protected $fillable = [
		'nombre',
		'ruta',
		'carpeta_id',
		'IDPDT'
	];

	public function plandetrabajo()
	{
		return $this->belongsTo(Plandetrabajo::class, 'IDPDT');
	}

	public function carpeta()
	{
		return $this->belongsTo(Carpeta::class);
	}
}
