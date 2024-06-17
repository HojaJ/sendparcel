<?php

namespace App\Models;

use App\Models\Traits\HasHashedMediaTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class BaseModel extends Model
{
//    use SoftDeletes;

    protected $guarded = [
        'id',
        '_token',
        '_method',
    ];



    /**
     * Get the list of all the Columns of the table.
     *
     * @return array Column names array
     */
    public function getTableColumns()
    {
        $table_name = DB::getTablePrefix().$this->getTable();

        return DB::select('SHOW COLUMNS FROM '.$table_name);
    }

    /**
     * Get Status Label.
     */
    public function getStatusLabelAttribute()
    {
        $return_string = '';

        switch ($this->attributes['status']) {
            case '0':
                $return_string = '<span class="badge bg-danger">Inactive</span>';
                break;

            case '1':
                $return_string = '<span class="badge bg-success">Active</span>';
                break;

            case '2':
                $return_string = '<span class="badge bg-warning text-dark">Pending</span>';
                break;

            default:
                $return_string = '<span class="badge bg-primary">Status:'.$this->status.'</span>';
                break;
        }

        return $return_string;
    }

    /**
     * Get Status Label.
     */
    public function getStatusLabelTextAttribute()
    {
        $return_string = '';

        switch ($this->attributes['status']) {
            case '0':
                $return_string = 'Inactive';
                break;

            case '1':
                $return_string = 'Active';
                break;

            case '2':
                $return_string = 'Pending';
                break;

            default:
                $return_string = $this->status;
                break;
        }

        return $return_string;
    }

    /**
     *  Set 'Name' attribute value.
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = trim($value);
    }

    /**
     * Set the 'Slug'.
     * If no value submitted 'Name' will be used as slug
     * str_slug helper method was used to format the text.
     */
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = slug_format(trim($value));

        if (empty($value)) {
            $this->attributes['slug'] = slug_format(trim($this->attributes['name']));
        }
    }

}
