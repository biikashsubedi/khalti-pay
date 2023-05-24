<input onkeydown="{{(isset($input['onkeydown']) && $input['onkeydown'] !== "") ? $input['onkeydown'] : ''}}" type="{{ $input['type'] ?? 'text' }}"
       class="form-control {{ (isset($input['error']) && $input['error'] !== "") ? 'is-invalid' : '' }} {{ isset($input['class']) ? $input['class'] : '' }}"
       value="{{$input['default'] ?? ''}}"
       placeholder="{{ $input['placeholder'] ?? $input['label'] ?? '' }}" name="{{$input['name'] ?? ''}}" id="{{$input['id'] ?? $input['name']}}"
    {{isset($input['disabled']) ? 'disabled' : ''}}
{{--    {{isset($input['required']) ? 'required' : ''}}--}}
    {{ isset($input['readonly']) ? 'readonly' : '' }}
    {{isset($input['checkReadOnly'] ) && $input['checkReadOnly'] ? 'readonly' : ''}}
    {{isset($input['min']) ? 'min='.$input['min'] : ''}}
    {{isset($input['max']) ? 'maxlength='.$input['max'] : ''}}
    {{isset($input['autoComplete']) ? 'autocomplete=nope' : ''}}
    {{isset($input['regex']) ? $input['regex'] : ''}}
    {{isset($input['markRequired']) ? 'required' : '' }}>

@if(isset($input['helpText']))
    <small class="form-text text-muted">{{ $input['helpText'] ?? '' }}</small>
@endif
@if(isset($input['error']))
    <div class="invalid-feedback">{{ $input['error'] }}</div>
@endif
@if(isset($input['append']) && $input['append'] == 'checkbox')
    <input type="checkbox" name="{{$input['name']}}Checkbox" class="{{$input['name']}}Checkbox" id="{{$input['name']}}-checkbox" style="margin-top: 10px">
    <label style="color: #7F7F7F" for="{{$input['name']}}-checkbox" class="{{$input['name']}}Checkbox"> <strong>{{translate('Auto Generate Coupon Code')}}</strong></label>
@endif
