@if(!isset($input['multiple']))
    <div class="multi_image_responsive">
        <input type="file" class="dropify {{ (isset($input['error']) && $input['error'] !== "") ? 'is-invalid' : '' }}"
               id="{{ $input['id'] ?? $input['name'] }}" accept="{{ $input['accept'] ?? '*' }}"
               name="{{ $input['name'] }}"
               {{ isset($input['disabled']) ? 'disabled' : '' }} {{ isset($input['multiple']) ? 'multiple' : '' }}
               data-default-file="{{$input['default'] ?? ''}}" {{ isset($input['data-id']) ? 'data-id='.$input['data-id'] : '' }}>
    </div>


    @if(isset($input['error']))
        <div style="color: #f26d75">{{$input['error']}}
        </div>
    @endif
@endif

@if(isset($input['multiple']))

    <div class="custom-file">
        <input type="file"
               class="form-group {{ (isset($input['customClass']) && $input['customClass'] !== "") ? $input['customClass'] : '' }}
         {{ isset($input['error']) && $input['error'] !== '' ? 'is-invalid' : '' }}"
               id="{{ $input['id'] ?? $input['name'] }}" accept="{{ $input['accept'] ?? '*' }}"
               name="{{ $input['name'] }}" {{ isset($input['disabled']) ? 'disabled' : '' }}
            {{ isset($input['multiple']) ? 'multiple' : '' }}>
        <label class="custom-file-label" for="{{ $input['id'] ?? $input['name'] }}">
            {{ translate($input['placeholder'] ?? '') }}</label>
    </div>
    @if (isset($input['helpText']))
        <small class="form-text text-muted">{{ $input['helpText'] ?? '' }}</small>
    @endif
    @if (isset($input['error']))
        <div class="invalid-feedback">{{ $input['error'] }}</div>
    @endif

@endif
