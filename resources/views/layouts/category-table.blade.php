<div class="row d-flex align-items-center" style="font-weight: bold; margin-top: 20px; border-bottom: 3px solid #dee2e6; border-top: 3px solid #dee2e6; padding: 10px 0;">
    <div class="col-1">№</div>
    <div class="col-2 d-flex justify-content-center">Title</div>
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
    <div class="col-1 d-flex justify-content-center">Date</div>
    <div class="col-1 d-flex justify-content-center">
        <div class="col-6">
            <i style="color: #49e309" class="fa fa-toggle-on"></i>
        </div>
        <div class="col-6">
            <i style="color: #49e309" class="fa fa-link"></i>
        </div>
    </div>
</div>

@foreach($datas as $key => $data)
    <div class="row " style="border-bottom: 0.5px solid #dee2e6; padding: 10px 0;">
        <div style="font-weight: bold;" class="col-1 d-flex align-items-center">{{$datas->firstItem() + $loop->index}}</div>
        <div class="col-2 d-flex justify-content-center" style="text-align: center">
            @if($data->title_ru){{$data->title_ru}}@else{{$data->title_tm}}@endif
        </div>
        <div class="col-1 d-flex justify-content-center align-items-center">{{$data->views}}</div>
        <div class="col-2" style="border-left: 3px solid rgb(222, 226, 230); border-right: 3px solid rgb(222, 226, 230); background-color: rgb(239 34 56 / 26%)">
            <div class="row h-50">
                <div style="border-bottom: 0.5px solid rgb(222, 226, 230); text-align: center; border-right: 0.5px solid rgb(222, 226, 230);" class="col-8 h-100 d-flex align-items-center">
                    <div class="w-100">
                        @if(isset($worker[$data->worker_ru]))
                            {{$worker[$data->worker_ru]}}
                        @else
                            Worker didn't select
                        @endif
                    </div>
                </div>
                <div style="text-align: center;" class="col-4 h-100 d-flex align-items-center">
                    <div class="w-100">@if(isset($data->viewsDetail)) {{$data->viewsDetail->ru}} @endif</div>
                </div>
            </div>
            <div class="row h-50">
                <div style="text-align: center; border-right: 0.5px solid rgb(222, 226, 230);" class="col-8 h-100 d-flex align-items-center">
                    <div class="w-100">
                        @if(isset($worker[$data->researcher_ru]))
                            {{$worker[$data->researcher_ru]}}
                        @else
                            Corrector didn't select
                        @endif
                    </div>
                </div>
                <div style="text-align: center;" class="col-4 h-100 d-flex align-items-center">
                    <div class="w-100">
                        @if($data->title_ru != null)
                            <i class="fa fa-check" style="color: green"></i>
                        @else
                            <i class="fa fa-times" style="color: red;"></i>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-2" style="background-color: rgba(139, 191, 142, 0.61)">
            <div class="row h-50" style="">
                <div style="border-bottom: 0.5px solid rgb(222, 226, 230); text-align: center; border-right: 0.5px solid rgb(222, 226, 230);" class="col-8 h-100 d-flex align-items-center">
                    <div class="w-100">
                        @if(isset($worker[$data->worker_tm]))
                            {{$worker[$data->worker_tm]}}
                        @else
                            Worker didn't select
                        @endif
                    </div>
                </div>
                <div style="text-align: center;" class="col-4 h-100 d-flex align-items-center">
                    <div class="w-100">@if(isset($data->viewsDetail)) {{$data->viewsDetail->tm}} @endif</div>
                </div>
            </div>
            <div class="row h-50">
                <div style="text-align: center; border-right: 0.5px solid rgb(222, 226, 230);" class="col-8 h-100 d-flex align-items-center">
                    <div class="w-100">
                        @if(isset($worker[$data->researcher_tm]))
                            {{$worker[$data->researcher_tm]}}
                        @else
                            Corrector didn't select
                        @endif
                    </div>
                </div>
                <div style="text-align: center;" class="col-4 h-100 d-flex align-items-center">
                    <div class="w-100">
                        @if($data->title_tm != null)
                            <i class="fa fa-check" style="color: green"></i>
                        @else
                            <i class="fa fa-times" style="color: red;"></i>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-2" style="border-left: 3px solid rgb(222, 226, 230); border-right: 3px solid rgb(222, 226, 230); background-color: rgba(122, 144, 236, 0.62);">
            <div class="row h-50" style="">
                <div style="border-bottom: 0.5px solid rgb(222, 226, 230); text-align: center; border-right: 0.5px solid rgb(222, 226, 230);" class="col-8 h-100 d-flex align-items-center">
                    <div class="w-100">
                        @if(isset($worker[$data->worker_en]))
                            {{$worker[$data->worker_en]}}
                        @else
                            Worker didn't select
                        @endif
                    </div>
                </div>
                <div style="text-align: center;" class="col-4 h-100 d-flex align-items-center">
                    <div class="w-100">@if(isset($data->viewsDetail)) {{$data->viewsDetail->en}} @endif</div>
                </div>
            </div>
            <div class="row h-50" style="">
                <div style="text-align: center; border-right: 0.5px solid rgb(222, 226, 230);" class="col-8 h-100 d-flex align-items-center">
                    <div class="w-100">
                        @if(isset($worker[$data->researcher_en]))
                            {{$worker[$data->researcher_en]}}
                        @else
                            Corrector didn't select
                        @endif
                    </div>
                </div>
                <div style="text-align: center;" class="col-4 h-100 d-flex align-items-center">
                    <div class="w-100">
                        @if($data->title_en != null)
                            <i class="fa fa-check" style="color: green"></i>
                        @else
                            <i class="fa fa-times" style="color: red;"></i>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div style="text-align: center;" class="col-1 d-flex align-items-center">
            <div class="d-flex justify-content-center">
                {{$data->created_at->format('M d Y, H:m')}}
            </div>
        </div>
        <div class="col-1 d-flex justify-content-center">
            <div class="d-flex align-items-center">
                <div class="col-6">
                    @if($data->status)
                        <i style="color: green" class="fa fa-check"></i>
                    @else
                        <i style="color: red" class="fa fa-times"></i>
                    @endif
                </div>
                <div class="col-6">
                    <a href="{{$url . $data->id}}" target="_blank">
                        <i style="color: #49e309" class="fa fa-external-link-alt"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endforeach
