@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-center">
        <div class="col-8" style="display: block">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">№</th>
                        <th scope="col">Ady</th>
                        <th scope="col">Familiyasy</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($workers as $worker)
                        <tr>
                            <a href="#">
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$worker->name}}</td>
                                <td>{{$worker->surname}}</td>
                            </a>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
