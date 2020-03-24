<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $type_id
 * @property string $code
 * @property string $description
 * @property string $seat_qty
 * @property Type $type
 * @property Rute[] $rutes
 */
class Trans extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'transportation';

    /**
     * @var array
     */
    protected $fillable = ['type_id', 'code', 'description', 'seat_qty'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo('App\Type');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function rutes()
    {
        return $this->hasMany('App\Rute');
    }
}
