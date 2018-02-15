@extends('layouts.app')

@php
    $title = !empty($auditor) ? 'Update an Auditor' : 'Add an Auditor';
@endphp

@section('title', $title)

@section('content')
<div class="container">
    @if (!empty($auditor))
        {!! Form::model($auditor, [
            'method' => 'PATCH',
            'route' => ['auditors.update', $auditor->id],
        ]) !!}
    @else
        {{ Form::open(['route' => 'auditors.store']) }}
    @endif
        <div class="row">
            <div class="col-md-12 text-right">
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" value="Save Changes">

                    @if (!empty($auditor))
                        <a class="btn btn-info" href="{{ route('auditors.edit', $auditor->id) }}">Restore</a>
                        <a class="btn btn-default" href="/auditors/{{ $auditor->id }}">Cancel</a>
                    @else
                        <a class="btn btn-default" href="/auditors">Cancel</a>
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{ $title }}
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                {!! BootForm::text('name') !!}
                                {!! BootForm::text('company') !!}
                                {!! BootForm::text('phone') !!}
                            </div>
                            <div class="col-md-6">
                                @include('partials.input_address')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {{ Form::close() }}
</div>
@endsection
