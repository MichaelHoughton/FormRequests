<div class="row">
    <div class="col-md-12">
        {!! BootForm::label('address_1') !!}
        <div>{{ $address && $address->address_1 ? $address->address_1 : 'n/a' }}</div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        {!! BootForm::label('address_2') !!}
        <div>{{ $address && $address->address_2 ? $address->address_2 : 'n/a' }}</div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        {!! BootForm::label('suburb') !!}
        <div>{{ $address && $address->suburb ? $address->suburb : 'n/a' }}</div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        {!! BootForm::label('post_code') !!}
        <div>{{ $address && $address->post_code ? $address->post_code : 'n/a' }}</div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        {!! BootForm::label('state') !!}
        <div>
            {{ $address && $address->state ? $address->state : 'n/a' }}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        {!! BootForm::label('country') !!}
        <div>
            {{ $address && $address->country ? $address->country : 'n/a' }}
        </div>
    </div>
</div>