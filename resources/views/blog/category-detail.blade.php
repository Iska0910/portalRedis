@extends('layouts.app')

@section('category-content')

    <div style="margin-left: 30px;">
        <a href="#">
            <i style="color: #a71f1f" class="fa fa-arrow-left fa-2x"></i>
        </a>
    </div>

    <div class="m-3">
        @include('layouts.category-table')
    </div>
@endsection
