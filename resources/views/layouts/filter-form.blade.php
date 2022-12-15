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
