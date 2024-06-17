<?php

namespace Modules\Car\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\City\Models\City;
use Modules\Parcel\Models\Parcel;

class Car extends BaseModel
{
    use HasFactory;
//    use SoftDeletes;

    protected $table = 'cars';
    protected $appends = ['busy'];

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\Car\database\factories\CarFactory::new();
    }

    public function getBusyAttribute()
    {
        return $this->parcels()->pluck('weight')->sum();
    }


    public function from_city()
    {
        return $this->belongsTo(City::class, 'from', 'id');
    }

    public function to_city()
    {
        return $this->belongsTo(City::class, 'to', 'id');
    }

    public function parcels()
    {
        return $this->hasMany(Parcel::class, 'car_id', 'id');
    }

//    public function ()
//    {
//
//    }

    public static function boot()
    {
        parent::boot();
        self::updating(function($model){
            if ($model->status === "0"){
                $model->from = null;
                $model->to = null;
                $model->date = null;
            }
        });
    }
}
