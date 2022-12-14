<div class="row d-flex align-items-center" style="font-weight: bold; margin-top: 20px; border-bottom: 3px solid #dee2e6; border-top: 3px solid #dee2e6; padding: 10px 0;">
    <div class="col-1">№</div>
    <div class="col-2 d-flex justify-content-center">Title</div>
    <div class="col-1 d-flex justify-content-center">Status</div>
    <div class="col-1 d-flex justify-content-center">Views</div>
    <div class="col-2" style="border-left: 3px solid rgb(222, 226, 230); border-right: 3px solid rgb(222, 226, 230);">
        <div class="d-flex justify-content-center mb-1">
            <img src="{{asset('storage/ru.png')}}">
        </div>
        <div class="row mt-3">
            <div style="text-align: center; border-right: 0.5px solid rgb(222, 226, 230); color: rgb(82, 141, 215);" class="col-8"><i class="fa fa-user"></i></div>
            <div style="text-align: center;" class="col-4"><i style="color: #528dd7" class="fa fa-eye"></i></div>
        </div>
    </div>
    <div class="col-2">
        <div class="d-flex justify-content-center mb-1">
            <img src="{{asset('storage/tm.png')}}">
        </div>
        <div class="row mt-3">
            <div style="text-align: center; border-right: 0.5px solid rgb(222, 226, 230); color: rgb(82, 141, 215);" class="col-8"><i class="fa fa-user"></i></div>
            <div style="text-align: center;" class="col-4"><i style="color: #528dd7" class="fa fa-eye"></i></div>
        </div>
    </div>
    <div class="col-2" style="border-left: 3px solid rgb(222, 226, 230); border-right: 3px solid rgb(222, 226, 230);">
        <div class="d-flex justify-content-center mb-1">
            <img src="{{asset('storage/en.png')}}">
        </div>
        <div class="row mt-3">
            <div style="text-align: center; border-right: 0.5px solid rgb(222, 226, 230); color: rgb(82, 141, 215);" class="col-8"><i class="fa fa-user"></i></div>
            <div style="text-align: center;" class="col-4"><i style="color: #528dd7" class="fa fa-eye"></i></div>
        </div>
    </div>
    <div class="col-1 d-flex justify-content-center"><i style="color: #49e309" class="fa fa-link"></i></div>
</div>

@foreach($datas as $data)
{{--    <div class="row d-flex align-items-center" style="border-bottom: 0.5px solid #dee2e6; padding: 10px 0;">--}}
    <div class="row " style="border-bottom: 0.5px solid #dee2e6; padding: 10px 0;">
        <div style="font-weight: bold;" class="col-1 d-flex align-items-center">{{$loop->iteration}}</div>
        <div class="col-2 d-flex justify-content-center" style="text-align: center">
            @if($data->title_ru){{$data->title_ru}}@else{{$data->title_tm}}@endif
        </div>
        <div class="col-1 d-flex justify-content-center align-items-center">
            @if($data->status)
                <i style="color: green" class="fa fa-check"></i>
            @else
                <i style="color: red" class="fa fa-times"></i>
            @endif
        </div>
        <div class="col-1 d-flex justify-content-center align-items-center">{{$data->views}}</div>
        <div class="col-2" style="border-left: 3px solid rgb(222, 226, 230); border-right: 3px solid rgb(222, 226, 230);">
            <div class="row h-100 d-flex align-items-center" style="background-color: rgb(239 34 56 / 26%)">
                <div style="text-align: center; border-right: 0.5px solid #000000;" class="col-8">
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
            <div style="background-color: rgb(139 191 142 / 61%);" class="row h-100 d-flex align-items-center">
                <div style="text-align: center; border-right: 0.5px solid #000000;" class="col-8">
                    @if(isset($worker[$data->worker_tm]))
                    {{$worker[$data->worker_tm]}}
                    @else
                        Didn't select
                    @endif
                </div>
                <div style="text-align: center;" class="col-4">@if(isset($data->viewsDetail)) {{$data->viewsDetail->tm}} @endif</div>
            </div>
        </div>
        <div class="col-2" style="border-left: 3px solid rgb(222, 226, 230); border-right: 3px solid rgb(222, 226, 230);">
            <div style="background-color: rgb(122 144 236 / 62%);" class="row h-100 d-flex align-items-center">
                <div style="text-align: center; border-right: 0.5px solid #000000;" class="col-8">
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
            <a href="{{$url . $data->id}}" target="_blank">
                <i style="color: #49e309" class="fa fa-external-link-alt"></i>
            </a>
        </div>
    </div>
@endforeach
