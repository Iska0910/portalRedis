<div class="d-flex justify-content-center">
    <div class="col-8" style="display: block">
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">№</th>
                <th scope="col">Categories</th>
                <th scope="col">Parent</th>
                <th scope="col">
                    <i style="color: #49e309" class="fa fa-link"></i>
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$category->name}}</td>
                    <td>
                        @if(isset($category->getParent))
                            {{$category->getParent->name_ru}}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        <a href="{{route($controller . '.category.dateail', $category->id)}}">
                            <i style="color: #49e309" class="fa fa-external-link-alt"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
