<div class="row pb-4 pt-3" style="margin: 30px 0 50px 0; background-color: #eaecef">
    <div class="col h-100">
        <h4 style="text-align: center; " class="h-100 p-4" >
            <div class="m-4"><span style="font-weight: bold">Table:</span> {{$tableName}}</div>
            <div class="m-4"><span style="font-weight: bold">Worker:</span> {{$worker->firstname}} {{$worker->lastname}}</div>
            <div class="m-4"><sapn style="font-weight: bold">Total count:</sapn>{{$datas->total()}}</div>
        </h4>
    </div>
    @if(isset($categories['count']))
        <div class="list-group col">
    @foreach(collect($categories['count'])->chunk(2) as $catContainer)
        <div class="row mt-2 clearfix" style="height: 40px !important;">
            @foreach($catContainer as $key => $catCount)
            <div class="col">
                <div class="p-2 h-100 list-group-item list-group-item-action list-group-item-primary">
                    <div class="h-100 float-left">
                        {{$categories['category'][$key]}}

                    </div>
                    <div class="float-right">{{$catCount}}</div>
                </div>
            </div>
            @endforeach
        </div>
    @endforeach
</div>
    @endif
</div>
