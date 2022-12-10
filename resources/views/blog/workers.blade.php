@extends('layouts.app')

@section('content')
    <div>
        <a href="{{route('blog.guide')}}">
            <i style="color: #a71f1f" class="fa fa-arrow-left fa-2x"></i>
        </a>
    </div>
    <div class="d-flex justify-content-center">
        <div class="col-8" style="display: block">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">№</th>
                        <th scope="col">Ady</th>
                        <th scope="col">Familiyasy</th>
                        <th scope="col">
                            <i style="color: #49e309" class="fa fa-link"></i>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($workers as $worker)
                        <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>{{$worker->name}}</td>
                            <td>{{$worker->surname}}</td>
                            <td>
                                <a href="{{$routes[$worker->id]}}">
                                    <i style="color: #49e309" class="fa fa-external-link-alt"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
