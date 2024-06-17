<div class="row">
    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            <?php
            $field_name = 'name';
            $field_lable = __(label_case($field_name));
            $field_placeholder = $field_lable;
            $required = "required";
            ?>
            {{ html()->label($field_lable, $field_name)->class('form-label') }} {!! fielf_required($required) !!}
            {{ html()->text($field_name)->class('form-control')->attributes(["$required"]) }}
        </div>
    </div>

    <div class="col-12 col-sm-4 mb-3">
        <div class="form-group">
            <?php
            $field_name = 'capacity';
            $field_lable = __(label_case($field_name)) . '(kg)';
            $field_placeholder = $field_lable;
            $required = "required";
            ?>
            {{ html()->label($field_lable, $field_name)->class('form-label') }} {!! fielf_required($required) !!}
            {{ html()->number($field_name)->class('form-control')->attributes(["$required"]) }}
        </div>
    </div>

    <div class="col-12 col-sm-4 mb-3 d-flex">
        <div class="form-group">
            <?php
            $field_name = 'image';
            $field_lable = __(label_case($field_name));
            $field_placeholder = $field_lable;
            $required = "";
            ?>
            {{ html()->label($field_lable, $field_name) }} {!! fielf_required($required) !!}
            {{ html()->file($field_name)->class('form-control')->attributes(["$required", "accept" => "image/png, image/gif, image/jpeg"]) }}

        </div>
        <img src="#" id="show_img" style="max-height: 50px; margin-left: 20px">
    </div>
</div>

<div class="row">
    <div class="col-12 col-sm-3 mb-3">
        <div class="form-group">
            <?php
            $field_name = 'status';
            $field_lable = __('Select status');
            $field_placeholder = __('labels.text.select_an_option');
            $required = "";
            $select_options = [
                0 => 'unavailable',
                1 => 'available',
            ];
            ?>
            {{ html()->label($field_lable, $field_name)->class('form-label') }} {!! fielf_required($required) !!}
            {{ html()->select($field_name, $select_options)->class('form-control')->attributes(["$required"]) }}
        </div>
    </div>

    <div class="col-12 col-sm-3 mb-3">
        <div class="form-group">
            <?php
            $field_name = 'from';
            $field_lable = __('From City');
            $field_placeholder = __('labels.text.select_an_option');
            $required = "$required";
            $cities = Modules\City\Models\City::select('id', 'name')->orderBy('name')->get();
            $city_options = [];
            foreach ($cities as $city) {
                $city_options[$city->id] = $city->name;
            }
            ?>
            {{ html()->label($field_lable, $field_name)->class('form-label') }} {!! fielf_required($required) !!}
            {{ html()->select($field_name, $city_options)->class('form-control')->attributes(["$required"]) }}
        </div>
    </div>

    <div class="col-12 col-sm-3 mb-3">
        <div class="form-group">
            <?php
            $field_name = 'to';
            $field_lable = __('To City');
            $field_placeholder = __('labels.text.select_an_option');
            $required = "$required";
            ?>
            {{ html()->label($field_lable, $field_name)->class('form-label') }} {!! fielf_required($required) !!}
            {{ html()->select($field_name, $city_options)->class('form-control')->attributes(["$required"]) }}
        </div>
    </div>

    <div class="col-12 col-sm-3 mb-3">
        <div class="form-group">
            <?php
            $field_name = 'date';
            $field_lable = __('Date');
            $field_placeholder = __('labels.text.select_an_option');
            $required = "$required";
            ?>
            {{ html()->label($field_lable, $field_name)->class('form-label') }} {!! fielf_required($required) !!}
            {{ html()->datetime($field_name)->class('form-control')->attributes(["$required"]) }}
        </div>
    </div>


</div>


@push('after-scripts')
    <script>
        const imgInp = document.getElementById('image');
        imgInp.onchange = evt => {
            const [file] = imgInp.files
            if (file) {
                document.getElementById('show_img').src = URL.createObjectURL(file)
            }
        }

        const status_select = $('#status'),
            from = $('#from'),
            to = $('#to'),
            date = $('#date');

        disableInput(status_select.val());

        status_select.on('change', function (e) {
            let selected = $(this).val();
            disableInput(selected)
        });
        
        function disableInput(selected) {
            if (selected === "0") {
                from.attr('disabled', true);
                to.attr('disabled', true);
                date.attr('disabled', true);
                console.log('disabled')
            } else {
                from.attr('disabled', false);
                to.attr('disabled', false);
                date.attr('disabled', false);
            }
        }

    </script>
@endpush