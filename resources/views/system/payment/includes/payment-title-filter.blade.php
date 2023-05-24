<div class="filter-group" style="margin-left: 8px">
    <label><strong>Payment Title</strong></label>
    <select wire:model="paymentTitle" class="form-control" style="width: 150px">
        <option value="">All Titles</option>
        @foreach((new \App\Model\PaymentMethod())->getSupportedPaymentCodes() as $key => $value)
            <option value="{{$key}}">
                {{ucwords($value)}}
            </option>
        @endforeach
    </select>
</div>
