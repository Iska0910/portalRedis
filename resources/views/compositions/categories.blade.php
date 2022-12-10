@extends('layouts.app')

@section('content')

    <div>
        <a href="{{route('comp.guide')}}">
            <i style="color: #a71f1f" class="fa fa-arrow-left fa-2x"></i>
        </a>
    </div>

    @include('layouts.categories-list')
@endsection
