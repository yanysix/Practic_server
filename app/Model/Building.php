<?php

namespace Model;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    protected $table = 'Building';
    protected $primaryKey = 'building_id';

    protected $fillable = [
        'name',
        'address',
        'total_number_seats',
        'total_auditorium_square'
    ];

    public $timestamps = false;

    public function rooms()
    {
        return $this->hasMany(Room::class, 'fk_building_id', 'building_id');
    }
}