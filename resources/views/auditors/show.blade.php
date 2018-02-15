@extends('layouts.app')

@php
    $title = $auditor->name;
@endphp

@section('title', $title)

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 text-right">
            <div class="form-group">
                {!! Form::open([
                    'method' => 'DELETE',
                    'route' => ['auditors.destroy', $auditor->id],
                    'class' => 'confirm-delete',
                ]) !!}

                    <a class="btn btn-primary" href="/auditors/{{ $auditor->id }}/edit">Edit</a>

                    <input class="btn btn-danger" type="submit" value="Delete">

                    <a class="btn btn-default" href="/auditors">Back</a>

                {!! Form::close()  !!}
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
                            {!! BootForm::label('name') !!}
                            <div>
                                {{ $auditor->name ? $auditor->name : null }}
                            </div>

                            {!! BootForm::label('company') !!}
                            <div>
                                {{ $auditor->company ? $auditor->company : null }}
                            </div>

                            {!! BootForm::label('phone') !!}
                            <div>
                                {{ $auditor->phone ? $auditor->phone : null }}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h3>Address</h3>

                            @include('partials.show_address', ['address' => $auditor->address])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $('.confirm-delete').on('submit', function(){
        return confirm('Are you sure you want to delete this auditor?');
    });
</script>
@append