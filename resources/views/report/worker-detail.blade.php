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

    <table class="table table-hover mt-4" style="text-align: center">
        <thead>
            <tr>
                <th scope="col">№</th>
                <th scope="col">Id</th>
                <th scope="col">Titile</th>
                <th scope="col">Status</th>
                <th scope="col">
                    <i style="color: #528dd7" class="fa fa-eye"></i>
                </th>
                <th scope="col">
                    <img src="{{asset('storage/ru.png')}}">
                </th>
                <th scope="col">
                    <img src="{{asset('storage/tm.png')}}">
                </th>
                <th scope="col">
                    <img src="{{asset('storage/en.png')}}">
                </th>
                <th scope="col">Date</th>
                <th scope="col">
                    <i style="color: #49e309" class="fa fa-link"></i>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($datas as $key => $data)
                <tr>
                    <th scope="row">{{$datas->firstItem() + $key}}</th>
                    <td>{{$data->id}}</td>
                    @if($data->title_ru)
                        <td>{{$data->title_ru}}</td>
                    @else
                        <td>{{$data->title_tm}}</td>
                    @endif
                    <td>
                        @if($data->status)
                            <i style="color: green" class="fa fa-check"></i>
                        @else
                            <i style="color: red" class="fa fa-times"></i>
                        @endif
                    </td>
                    <td>{{$data->view_count}}</td>
                    @if(isset($data->viewsDetail))
                        <td>{{$data->viewsDetail->ru}}</td>
                        <td>{{$data->viewsDetail->tm}}</td>
                        <td>{{$data->viewsDetail->en}}</td>
                    @else
                        <td></td>
                        <td></td>
                        <td></td>
                    @endif
                    <td>{{$data->created_at->format('M d Y')}}</td>
                    <td>
                        @if($data->title_ru != "")
                            <a href="https://turkmenportal.com/blog/{{$data->id}}" target="_blank">
                                <i style="color: #49e309" class="fa fa-external-link-alt"></i>
                            </a>
                        @elseif($data->title_tm != "")
                            <a href="https://turkmenportal.com/tm/blog/{{$data->id}}" target="_blank">
                                <i style="color: #49e309" class="fa fa-external-link-alt"></i>
                            </a>
                        @else
                            <a href="https://turkmenportal.com/en/blog/{{$data->id}}" target="_blank">
                                <i style="color: #49e309" class="fa fa-external-link-alt"></i>
                            </a>
                        @endif
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>

    <div class="d-flex justify-content-center" style="margin-top: 50px;">
        {{ $datas->withQueryString()->links() }}
    </div>
@endsection
