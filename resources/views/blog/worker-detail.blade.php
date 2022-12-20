@extends('layouts.app')

@section('content')

    <div>
        <a href="{{$workersListRoute}}">
            <i style="color: #a71f1f" class="fa fa-arrow-left fa-2x"></i>
        </a>
    </div>

    @include('layouts.worker-by-category-table', ['tableName' => 'Blog'])

    @include('layouts.filter-form')

    @include('layouts.worker-table')

    <div class="d-flex justify-content-center" style="margin-top: 50px;">
        {{ $datas->withQueryString()->links() }}
    </div>
@endsection
