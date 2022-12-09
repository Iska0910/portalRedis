<div class="row d-flex align-items-center" style="font-weight: bold; margin-top: 20px; border-bottom: 2px solid #dee2e6; border-top: 2px solid #dee2e6; padding: 10px 0;">
    <div class="col-1">№</div>
    <div class="col-2 d-flex justify-content-center">Title</div>
    <div class="col-1 d-flex justify-content-center">Status</div>
    <div class="col-1 d-flex justify-content-center">Views</div>
    <div class="col-2" style="border-left: 2px solid rgb(222, 226, 230); border-right: 2px solid rgb(222, 226, 230);">
        <div class="d-flex justify-content-center mb-1">
            <img src="{{asset('storage/ru.png')}}">
        </div>
        <div class="row">
            <div style="text-align: center;" class="col">Worker</div>
            <div style="text-align: center;" class="col">View</div>
        </div>
    </div>
    <div class="col-2">
        <div class="d-flex justify-content-center mb-1">
            <img src="{{asset('storage/tm.png')}}">
        </div>
        <div class="row">
            <div style="text-align: center;" class="col">Worker</div>
            <div style="text-align: center;" class="col">View</div>
        </div>
    </div>
    <div class="col-2" style="border-left: 2px solid rgb(222, 226, 230); border-right: 2px solid rgb(222, 226, 230);">
        <div class="d-flex justify-content-center mb-1">
            <img src="{{asset('storage/en.png')}}">
        </div>
        <div class="row">
            <div style="text-align: center;" class="col">Worker</div>
            <div style="text-align: center;" class="col">View</div>
        </div>
    </div>
    <div class="col-1 d-flex justify-content-center"><i style="color: #49e309" class="fa fa-link"></i></div>
</div>

@foreach($datas as $data)
    <div class="row d-flex align-items-center" style="border-bottom: 1px solid #dee2e6; padding: 10px 0;">
        <div style="font-weight: bold;" class="col-1">{{$loop->iteration}}</div>
        <div class="col-2 d-flex justify-content-center" style="text-align: center">
            @if($data->title_ru){{$data->title_ru}}@else{{$data->title_tm}}@endif
        </div>
        <div class="col-1 d-flex justify-content-center">
            @if($data->status)
                <i style="color: green" class="fa fa-check"></i>
            @else
                <i style="color: red" class="fa fa-times"></i>
            @endif
        </div>
        <div class="col-1 d-flex justify-content-center">{{$data->views}}</div>
        <div class="col-2" style="border-left: 2px solid rgb(222, 226, 230); border-right: 2px solid rgb(222, 226, 230);">
            <div class="row">
                <div style="text-align: center; border-right: 1px solid rgb(222, 226, 230);" class="col-8">
                    @if(isset($worker[$data->worker_ru]))
                    {{$worker[$data->worker_ru]}}
                    @else
                        Didn't select
                    @endif
                </div>
                <div style="text-align: center;" class="col-4">@if(isset($data->viewsDetail)) {{$data->viewsDetail->ru}} @endif</div>
            </div>
        </div>
        <div class="col-2">
            <div class="row">
                <div style="text-align: center; border-right: 1px solid rgb(222, 226, 230);" class="col-8">
                    @if(isset($worker[$data->worker_tm]))
                    {{$worker[$data->worker_tm]}}
                    @else
                        Didn't select
                    @endif
                </div>
                <div style="text-align: center;" class="col-4">@if(isset($data->viewsDetail)) {{$data->viewsDetail->tm}} @endif</div>
            </div>
        </div>
        <div class="col-2" style="border-left: 2px solid rgb(222, 226, 230); border-right: 2px solid rgb(222, 226, 230);">
            <div class="row">
                <div style="text-align: center; border-right: 1px solid rgb(222, 226, 230);" class="col-8">
                    @if(isset($worker[$data->worker_en]))
                    {{$worker[$data->worker_en]}}
                    @else
                        Didn't select
                    @endif
                </div>
                <div style="text-align: center;" class="col-4">@if(isset($data->viewsDetail)) {{$data->viewsDetail->en}} @endif</div>
            </div>
        </div>
        <div class="col-1 d-flex justify-content-center">
            <a href="#" target="_blank">
                <i style="color: #49e309" class="fa fa-external-link-alt"></i>
            </a>
        </div>
    </div>
@endforeach
