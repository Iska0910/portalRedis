@extends('layouts.app')

@section('category-content')

    <div style="margin-left: 30px;">
        <a href="{{$backUrl}}">
            <i style="color: #a71f1f" class="fa fa-arrow-left fa-2x"></i>
        </a>
    </div>

    <h4 style="text-align: center; margin: 20px 0;">
        <div class="row" >
            <div class="col-4">
                <div class="col"><span style="font-weight: bold">Table:</span> Composition</div>
            </div>
            <div class="col-4">
                <div class="col"><span style="font-weight: bold">Category:</span>
                    @if($category->name_ru != '')
                        {{$category->name_ru}}
                    @else
                        {{$category->name_tm}}
                    @endif
                </div>
            </div>
            <div class="col-4">
                <div class="col"><sapn style="font-weight: bold">Total count:</sapn>{{$datas->total()}}</div>
            </div>

        </div>
    </h4>

    <h4 style="text-align: center; margin-bottom: 20px;">
        <div class="row" >
            <div class="col-4">
                <div class="">
                    <img src="{{asset('storage/ru.png')}}">
                    <span>
                        {{$posts['ru']}}
                    </span>
                </div>
            </div>
            <div class="col-4">
                <div class="">
                    <img src="{{asset('storage/tm.png')}}">
                    <span>
                        {{$posts['tm']}}
                    </span>
                </div>
            </div>
            <div class="col-4">
                <div class="">
                    <img src="{{asset('storage/en.png')}}">
                    <span>
                        {{$posts['en']}}
                    </span>
                </div>
            </div>

        </div>
    </h4>


    @include('layouts.category-filter-form')

    <div class="m-3">
        @include('layouts.category-table')
    </div>

    <div class="d-flex justify-content-center" style="margin-top: 50px;">
        {{ $datas->withQueryString()->links() }}
    </div>
@endsection
