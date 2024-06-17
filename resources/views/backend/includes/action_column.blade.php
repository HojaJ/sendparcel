<div class="d-flex gap-2">
    @can('delete_'.$module_name)
        <form id="delete-form"
              action="{{route("backend.$module_name.destroy", $data)}}"
              method="POST">
            @method('DELETE')
            @csrf
            <button class="btn btn-danger btn-delete" title="{{__('labels.backend.delete')}}" type="submit"><i class="fas fa-trash-alt"></i></button>
        </form>
    @endcan
    @can('edit_'.$module_name)
        <x-buttons.edit route='{!!route("backend.$module_name.edit", $data)!!}' title="{{__('Edit')}} {{ ucwords(Str::singular($module_name)) }}" small="true" />
    @endcan
</div>
