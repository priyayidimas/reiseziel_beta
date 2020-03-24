<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $transportation_id
 * @property string $depart_at
 * @property string $rute_from
 * @property string $rute_to
 * @property string $duration
 * @property float $price
 * @property Transportation $transportation
 * @property Reservation[] $reservations
 */
class Rute extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'rute';

    /**
     * @var array
     */
    protected $fillable = ['transportation_id', 'depart_at', 'rute_from', 'rute_to', 'duration', 'price'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function transportation()
    {
        return $this->belongsTo('App\Transportation');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reservations()
    {
        return $this->hasMany('App\Reservation');
    }
}
