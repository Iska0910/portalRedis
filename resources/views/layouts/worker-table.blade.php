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
            <th scope="row"  style="vertical-align: middle">
                {{$datas->firstItem() + $key}}
            </th>
            <td style="vertical-align: middle">{{$data->id}}</td>
            @if($data->title_ru)
                <td style="vertical-align: middle">{{$data->title_ru}}</td>
            @else
                <td style="vertical-align: middle">{{$data->title_tm}}</td>
            @endif
            <td style="vertical-align: middle">
                @if($data->status)
                    <i style="color: green" class="fa fa-check"></i>
                @else
                    <i style="color: red" class="fa fa-times"></i>
                @endif
            </td>
            <td style="vertical-align: middle">{{$data->view_count}}</td>
            @if(isset($data->viewsDetail))
                <td style="vertical-align: middle; background-color: rgba(239, 34, 56, 0.26);">{{$data->viewsDetail->ru}}</td>
                <td style="vertical-align: middle; background-color: rgba(139, 191, 142, 0.61);">{{$data->viewsDetail->tm}}</td>
                <td style="vertical-align: middle; background-color: rgba(122, 144, 236, 0.62);">{{$data->viewsDetail->en}}</td>
            @else
                <td></td>
                <td></td>
                <td></td>
            @endif
            <td style="vertical-align: middle">{{$data->created_at->format('M d Y')}}</td>
            <td style="vertical-align: middle">
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
