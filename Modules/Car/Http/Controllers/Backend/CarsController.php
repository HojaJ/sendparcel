<?php

namespace Modules\Car\Http\Controllers\Backend;

use App\Authorizable;
use App\Http\Controllers\Backend\BackendBaseController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Modules\City\Models\City;
use Yajra\DataTables\DataTables;

class CarsController extends BackendBaseController
{
    use Authorizable;

    public function __construct()
    {

        // Page Title
        $this->module_title = 'Cars';

        // module name
        $this->module_name = 'cars';

        // directory path of the module
        $this->module_path = 'car::backend';

        // module icon
        $this->module_icon = 'fa-regular fa-sun';

        // module model name, path
        $this->module_model = "Modules\Car\Models\Car";
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
        if (auth()->user()->roles->pluck('name')[0] === 'deliveryman'){
            $$module_name = $module_model::where('user_id', auth()->user()->id)->select('id', 'name', 'status', 'image', 'from', 'to', 'capacity', 'date');
        }else{
            $$module_name = $module_model::select('id', 'name', 'status', 'image', 'from', 'to', 'capacity', 'date');
        }


        $data = $$module_name;

        return Datatables::of($$module_name)
            ->addColumn('action', function ($data) {
                $module_name = $this->module_name;
                if (auth()->user()->roles->pluck('name')[0] === 'deliveryman'){
                    return view('backend.includes.action_column', compact('module_name', 'data'));
                }
            })
            ->editColumn('name', '<strong>{{$name}}</strong>')
            ->editColumn('status', function ($data) {
                if ($data->status === 0) {
                    return 'Unavailable';
                } else {
                    return 'Available';
                }
            })
            ->editColumn('from', function ($data) {
                return $data->from_city?->name;
            })
            ->editColumn('to', function ($data) {
                return $data->to_city?->name;
            })
            ->editColumn('image', '<img src={{asset($image)}} style="max-height:60px;" />')
            ->rawColumns(['name', 'action', 'image'])
            ->orderColumns(['id'], '-:column $1')
            ->make(true);
    }

    public function edit($id)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Edit';

        $$module_name_singular = $module_model::findOrFail($id);

        return view(
            "{$module_path}.{$module_name}.edit",
            compact('module_title', 'module_name', 'module_path', 'module_icon', 'module_action', 'module_name_singular', "{$module_name_singular}")
        );
    }

    public function store(Request $request)
    {
        $module_title = $this->module_title;

        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Store';
        $image = null;
        if ($request->hasFile('image')) {

            $path = public_path('files/');
            !is_dir($path) && mkdir($path, 0777, true);
            $fileName = time() . '.' . $request->image->extension();
            $request->image->move($path, $fileName);
            $image = 'files/' . $fileName;
        }

        $$module_name_singular = $module_model::create(array_merge($request->all(), ['user_id' => auth()->id(), 'image' => $image]));

        flash(icon() . Str::singular($module_title) . " " . __('Added'))->success()->important();

//        logUserAccess($module_title.' '.$module_action.' | Id: '.$$module_name_singular->id);

        return redirect("admin/{$module_name}");
    }


    public function update(Request $request, $id)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'Update';

        $$module_name_singular = $module_model::findOrFail($id);

        $image = $$module_name_singular->image;
        if ($request->hasFile('image')) {
            $path = public_path('files/');
            !is_dir($path) && mkdir($path, 0777, true);
            $fileName = time() . '.' . $request->image->extension();

            \File::delete($$module_name_singular->image);
            $request->image->move($path, $fileName);
            $image = 'files/' . $fileName;
        }


        $$module_name_singular->update(array_merge($request->all(), ['image' => $image]));

        flash(icon() . ' ' . Str::singular($module_title) . " " . __('Updated'))->success()->important();

        logUserAccess($module_title . ' ' . $module_action . ' | Id: ' . $$module_name_singular->id);

        return redirect()->route("backend.{$module_name}.index", $$module_name_singular->id);
    }

    public function destroy($id)
    {
        $module_title = $this->module_title;
        $module_name = $this->module_name;
        $module_path = $this->module_path;
        $module_icon = $this->module_icon;
        $module_model = $this->module_model;
        $module_name_singular = Str::singular($module_name);

        $module_action = 'destroy';

        $$module_name_singular = $module_model::findOrFail($id);
        \File::delete($$module_name_singular->image);

        $$module_name_singular->delete();

        flash(icon() . '' . label_case($module_name_singular) . ' ' . __('Deleted'))->success()->important();

        return redirect("admin/{$module_name}");
    }

}
