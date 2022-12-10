@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col">
            <a href="{{route('blog.guide')}}" class="home-links">
                <div style="background-color: rgba(144, 199, 237, 0.56); height: 200px; border-radius: 25px;" class="d-flex justify-content-center home-container">
                    <div class="d-flex align-items-center" style="font-size: 18px; font-weight: bold; color: #ffff;">
                        Blog
                    </div>
                </div>
            </a>
        </div>
        <div class="col">
            <a href="{{route('comp.guide')}}" class="home-links">
                <div style="background-color: rgba(144, 199, 237, 0.56); height: 200px; border-radius: 25px;" class="d-flex justify-content-center home-container">
                    <div class="d-flex align-items-center" style="font-size: 18px; font-weight: bold; color: #ffff;">
                        Compositions
                    </div>
                </div>
            </a>
        </div>
    </div>
@endsection
