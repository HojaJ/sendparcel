<?php

namespace Modules\Parcel\Http\Controllers\Backend;

use App\Authorizable;
use App\Http\Controllers\Backend\BackendBaseController;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class ParcelsController extends BackendBaseController
{
    use Authorizable;

    public function __construct()
    {
        // Page Title
        $this->module_title = 'Parcels';

        // module name
        $this->module_name = 'parcels';

        // directory path of the module
        $this->module_path = 'parcel::backend';

        // module icon
        $this->module_icon = 'fa-regular fa-sun';

        // module model name, path
        $this->module_model = "Modules\Parcel\Models\Parcel";
    }

    public function index_data()
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'List';

        $page_heading = label_case($module_title);
        $title = $page_heading . ' ' . label_case($module_action);
        if (auth()->user()->roles->pluck('name')[0] === 'client') {
            $$module_name = $module_model::with('car')->where('user_id', auth()->user()->id);
        } else {
            $$module_name = $module_model::with('car');
        }


        $data = $$module_name;

        return Datatables::of($$module_name)
            ->addColumn('action', function ($data) {
                $module_name = $this->module_name;
                if (auth()->user()->roles->pluck('name')[0] === 'client') {
                    return view('backend.includes.action_column', compact('module_name', 'data'));
                }
            })
            ->addColumn('car', function ($data) {
                return $data->car->name .'<br/>'. __('Capacity')  . ' (kg): ' . $data->car->capacity . '&nbsp;&nbsp;' . __('Busy') . ':&nbsp;' . $data->car->busy . ' (kg)' . '&nbsp;&nbsp;' . __('Remain') . ':&nbsp;' . ($data->car->capacity - $data->car->busy) . ' (kg)';
            })
            ->rawColumns(['action', 'car'])
            ->orderColumns(['id'], '-:column $1')
            ->make(true);
    }


}
