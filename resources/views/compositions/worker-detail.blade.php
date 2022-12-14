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

    <div class="d-flex justify-content-end">
        <div class="col-6" style="border: 1px solid #a71f1f; padding: 20px 30px; border-radius: 10px; margin: 20px 0;">
            <form action="" method="GET">
                <div class="row">
                    <div class="col">
                        <input class="form-control" type="date" name="start" value="{{old('start')}}" id="Begin-date">
                    </div>
                    <div class="col">
                        <input class="form-control" type="date" name="end" value="{{old('end')}}" id="End-date">
                    </div>
                    <div class="col">
                        <button class="form-control btn btn-primary" type="submit" name="submit">
                            <i  class="fa fa-sort-amount-up-alt"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @include('layouts.worker-table')

    <div class="d-flex justify-content-center" style="margin-top: 50px;">
        {{ $datas->withQueryString()->links() }}
    </div>
@endsection
