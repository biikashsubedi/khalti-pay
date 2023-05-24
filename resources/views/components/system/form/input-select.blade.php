
<select name="{{ $input['name'] ?? '' }}" id="{{ $input['id'] ?? $input['name'] ?? ''}}"
        class="form-control {{ (isset($input['error']) && $input['error'] !== "") ? 'is-invalid' : '' }} {{$input['class'] ?? ''}}"
        {{ (isset($input['disabled']) && $input['disabled'] !== "") ? 'disabled' : '' }}
        {{ (isset($input['required']) && $input['required'] !== "") ? 'required' : '' }}
        {{ isset($input['multiple']) ? 'multiple' : '' }} data-url="{{url('/')}}">
    @if(isset($input['placeholder']))
        <option value="">{{ $input['placeholder'] }}</option>
    @endif
    @if(isset($input['options']))
        @foreach($input['options'] as $key=>$value)
            <option value="{{ strtolower($key) }}" {{ $input['default'] == strtolower($key) ? 'selected' : '' }}

            >{{ (isset($input['label']) && $input['label'] == 'Url') ? strtolower($value) : ucwords($value) }}</option>
        @endforeach
    @endif
</select>
@if(isset($input['helpText']))
    <small class="form-text text-muted">{{ $input['helpText'] ?? '' }}</small>
@endif
@if(isset($input['error']))
    <div class="invalid-feedback">{{$input['error']}}
    </div>
@endif
