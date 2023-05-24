@foreach($input['options'] as $radioOption)
<div class="form-check {{ isset($input['stacked']) ? '' : 'form-check-inline' }}">
  <input class="form-check-input {{$input['class'] ?? '' }}" type="radio"
         id="{{ $input['name'] }}-{{ $radioOption['value'] }}"
         value="{{ $radioOption['value'] }}"
         @if($input['default'] == $radioOption['value'])
         checked
         @endif
         @if(isset($input['onchange']) && $input['onchange'] == 'submit')
         onchange="submit()"
         @endif
         name="{{ $input['name'] }}" {{ isset($input['disabled']) ? 'disabled' : '' }} >
  <label class="form-check-label" for="{{ $input['name'] }}-{{ $radioOption['value'] }}">{{ $radioOption['label'] ?? $radioOption['key'] }}</label>
</div>
@endforeach

@if(isset($input['helpText']))
  <small class="form-text text-muted">{{ translate($input['helpText']) ?? '' }}</small>
@endif
@if(isset($input['error']))
    <div class="">
        <span class="text-danger">{{$input['error']}}</span>
    </div>
@endif
