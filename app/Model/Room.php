<?php

namespace Model;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = 'Rooms';
    protected $primaryKey = 'room_id';

    protected $fillable = [
        'name',
        'room_type',
        'square',
        'count_seats',
        'fk_building_id'
    ];

    public $timestamps = false;

    public function building()
    {
        return $this->belongsTo(Building::class, 'fk_building_id', 'building_id');
    }
}