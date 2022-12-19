<div class="d-flex justify-content-end">
    <div class="col-8" style="border: 1px solid #a71f1f; padding: 20px 30px; border-radius: 10px; margin: 20px 0;">
        <form action="" method="GET">
            <div class="row">
                <div class="col">
                    <label for="Worker">Worker</label>
                    <select class="form-control" id="Worker" name="worker">
                        <option selected="selected" value="0">All</option>
                        @foreach($worker as $id => $v)
                            <option @if(old('worker') == $id)selected="selected"@endif value="{{$id}}">{{$v}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <label for="From">From</label>
                    <input class="form-control" id="From" type="date" name="start" value="{{old('start')}}" id="Begin-date">
                </div>
                <div class="col">
                    <label for="To">To</label>
                    <input class="form-control" id="To" type="date" name="end" value="{{old('end')}}" id="End-date">
                </div>
                <div class="col d-flex align-items-end">
                    <button class="form-control btn btn-primary" type="submit" name="submit">
                        <i  class="fa fa-sort-amount-up-alt"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
