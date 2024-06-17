<?php

namespace Modules\Parcel\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Car\Models\Car;

class Parcel extends BaseModel
{
    use HasFactory;
    protected $table = 'parcels';

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\Parcel\database\factories\ParcelFactory::new();
    }

    public function car()
    {
        return $this->belongsTo(Car::class,'car_id', 'id');
    }
}
