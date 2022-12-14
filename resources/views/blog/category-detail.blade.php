@extends('layouts.app')

@section('category-content')

    <div style="margin-left: 30px;">
        <a href="{{$backUrl}}">
            <i style="color: #a71f1f" class="fa fa-arrow-left fa-2x"></i>
        </a>
    </div>

    <div class="m-3">
        @include('layouts.category-table')
    </div>

    <div class="d-flex justify-content-center" style="margin-top: 50px;">
        {{ $datas->withQueryString()->links() }}
    </div>
@endsection
