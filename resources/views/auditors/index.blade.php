@extends('layouts.app')

@php
    $title = 'Manage Auditors';
@endphp

@section('title', $title)

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 text-right">
            <p>
                <a class="btn btn-primary" href="/auditors/create">Add an Auditor</a>
            </p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ $title }}
                </div>

                <div class="panel-body">
                    @if (count($auditors))
                        <table class="table table-bordered">
                            <tr>
                                <th>Name</th>
                                <th>Company</th>
                                <th>Phone Number</th>
                                <th>Options</th>
                            </tr>

                            @foreach ($auditors as $auditor)
                                <tr>
                                    <td>{{ $auditor->name }}</td>
                                    <td>{{ $auditor->company }}</td>
                                    <td>{{ $auditor->phone }}</td>
                                    <td>
                                        {!! Form::open([
                                            'method' => 'DELETE',
                                            'class' => 'confirm-delete',
                                            'url' => '/auditors/'.$auditor->id,
                                        ]) !!}

                                            <a class="btn btn-primary" href="/auditors/{{ $auditor->id }}">View</a>

                                            <button class="btn btn-danger">Delete</button>

                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <p>There are no auditors at the moment!</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    $('.confirm-delete').on('submit', function(){
        return confirm('Are you sure you want to delete this auditor?');
    });
</script>
@append
