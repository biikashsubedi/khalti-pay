@php
    if (isset($input['ratio'])){
        $label = isset($input['ratio']) ? $input['ratio'] : '';
        $value = \App\Model\Config::getRatioValue($label);
        $isRatioEnabled = \App\Model\Config::getBooleanValue($label);
    }
@endphp

<div class="form-group row {{ $input['formGroupClass'] ?? '' }} " id="{{ $input['groupId'] ?? '' }}">
    <label style="pointer-events: none;" for="{{ $input['name'] ?? '' }}"
           class="col-sm-2 col-form-label {{ (isset($input['required']) || isset($input['label-required'])) ? 'require' : '' }}"
        {{ (isset($input['disabled']) && $input['disabled'] !== "") ? 'disabled' : '' }}
        {{ (isset($input['readonly']) && $input['readonly'] !== "") ? 'readonly' : '' }}>
        {{ isset($input['label']) ? $input['label'] : '' }}

        @if(isset($input['ratio']) && $isRatioEnabled)
                <span class="tx-danger">(Ratio: {{str_replace('/', ':',$value)}})</span>
        @endif

        @if(isset($input['required']) || isset($input['label-required']))
            <span class="tx-danger">*</span>
        @endif
        @if(isset($input['addLabelMessage']))
        <span class="tx-danger" id="{{$input['addLabelMessage']}}">
        </span>
        @endif
    </label>

    <div class="{{ isset($input['fullWidth']) ? 'col-sm-10' : 'col-sm-6' }}">
        @if(isset($inputs))
            {{$inputs}}
        @else
            <x-system.form.input-normal :input="$input"/>
        @endif
    </div>
</div>
