@extends('layouts.app')

@section('content')

    <div>
        <a href="{{route('home')}}">
            <i style="color: #a71f1f" class="fa fa-arrow-left fa-2x"></i>
        </a>
    </div>

    <div class="d-flex justify-content-center mt-4">
        <div class="col-8">
            <a href="{{route($controller . '.workers')}}" class="home-links">
                <div style="background-color: rgba(144, 199, 237, 0.56); height: 200px; border-radius: 25px;" class="d-flex justify-content-center home-container">
                    <div class="d-flex align-items-center" style="font-size: 25px; font-weight: bold; color: #ffff;">
                        By workers
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-4">
        <div class="col-8">
            <a href="{{route($controller . '.categories')}}" class="home-links">
                <div style="background-color: rgba(144, 199, 237, 0.56); height: 200px; border-radius: 25px;" class="d-flex justify-content-center home-container">
                    <div class="d-flex align-items-center" style="font-size: 25px; font-weight: bold; color: #ffff;">
                        By categories
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-4">
        <div class="col-8">
            <a href="#" class="home-links">
                <div style="background-color: rgba(144, 199, 237, 0.56); height: 200px; border-radius: 25px;" class="d-flex justify-content-center home-container">
                    <div class="d-flex align-items-center" style="font-size: 25px; font-weight: bold; color: #ffff;">
                        By languages
                    </div>
                </div>
            </a>
        </div>
    </div>

@endsection
