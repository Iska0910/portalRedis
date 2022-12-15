@extends('layouts.app')

@section('content')

    <div>
        <a href="{{$workersListRoute}}">
            <i style="color: #a71f1f" class="fa fa-arrow-left fa-2x"></i>
        </a>
    </div>

    <h4 style="text-align: center">
        <div class="row">
            <div class="col"><span style="font-weight: bold">Worker:</span> {{$worker->firstname}} {{$worker->lastname}}</div>
            <div class="col"><sapn style="font-weight: bold">Total count:</sapn>{{$datas->total()}}</div>
        </div>
    </h4>

    @include('layouts.filter-form')

    @include('layouts.worker-table')

    <div class="d-flex justify-content-center" style="margin-top: 50px;">
        {{ $datas->withQueryString()->links() }}
    </div>
@endsection
