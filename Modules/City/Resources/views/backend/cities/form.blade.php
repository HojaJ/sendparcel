<div class="row">
    <div class="col-12 col-sm-6 mb-3">
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
</div>