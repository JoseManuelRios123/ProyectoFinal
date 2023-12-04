<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Carpeta
 * 
 * @property int $id_carpeta
 * @property int $id_Proyecto
 * @property string $nombre
 * 
 * @property Proyecto $proyecto
 * @property Collection|Archivo[] $archivos
 *
 * @package App\Models
 */
class Carpeta extends Model
{
	protected $table = 'carpetas';
	protected $primaryKey = 'id_carpeta';
	public $timestamps = false;

	protected $casts = [
		'id_Proyecto' => 'int'
	];

	protected $fillable = [
		'id_Proyecto',
		'nombre'
	];

	public function proyecto()
	{
		return $this->belongsTo(Proyecto::class, 'id_Proyecto');
	}

	public function archivos()
	{
		return $this->hasMany(Archivo::class);
	}
}
