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
 * 
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
		'carpeta_id' => 'int'
	];

	protected $fillable = [
		'nombre',
		'ruta',
		'carpeta_id'
	];

	public function carpeta()
	{
		return $this->belongsTo(Carpeta::class);
	}
}
