<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BlogStatisticsController extends Controller
{
    public function workersList()
    {
        $workers = Worker::query()
            ->select('id', 'firstname as name', 'lastname as surname')
            ->orderBy('lastname')
            ->orderBy('firstname')
            ->get();


        $routes = [];

        foreach ($workers as $worker){
            $routes[$worker->id] = route('blog.worker.detail', $worker->id);
        }

        return view('blog.workers', compact('workers', 'routes'));
    }

    public function workerDetail(Request $request, $id)
    {
        $worker = Worker::query()
            ->find((int)$id);

        $workersListRoute = route('blog.workers');

        $begin = Carbon::parse($request->start)->startOfDay();
        $end = Carbon::parse($request->end)->endOfDay();

        $datas = Blog::query()
            ->when($request->start, function ($q) use ($begin){
                $q->whereDate('date_added', '>=', $begin);
            })
            ->when($request->end, function ($q) use ($end){
                $q->whereDate('date_added', '<=', $end);
            })
            ->where(function ($q) use ($worker) {
                $q->where('worker_ru',  $worker->id)
                    ->orwhere('worker_tm', '=', $worker->id)
                    ->orWhere('worker_en', '=', $worker->id);
            })
            ->select('id', 'title_ru','title_tm', 'visited_count as view_count', 'status', 'date_added as created_at')
            ->with('viewsDetail')
            ->orderBy('date_added', 'desc')
            ->paginate(15);

        session()->flashInput($request->input());

        return view('blog.BlogStatisticsControllerworker-detail', compact('datas', 'worker', 'workersListRoute'));
    }

    public function categoriesList()
    {
        $categories = Category::query()
            ->where('status', 1)
            ->where('parent_id', '!=', null)
            ->where(function($q){
                $q->Where('parent_id', 282)
                    ->orWhere('parent_id', 338)
                    ->orWhere('parent_id', 430);
            })
            ->orderByDesc('parent_id')
            ->orderBy('name_ru', 'asc')
            ->select('id', 'name_ru as name', 'parent_id')
            ->with('getParent:id,name_ru')
            ->get();

        $controller = 'blog';

        return view('blog.categories', compact('categories', 'controller'));
    }

    public function categoryDetail(Category $category)
    {
        $datas = Blog::query()
            ->where('category_id', $category->id)
            ->select('id', 'title_ru', 'title_tm', 'visited_count as views', 'status', 'date_added as created_at', 'worker_ru', 'worker_tm', 'worker_en')
            ->with('viewsDetail')
            ->orderByDesc('date_added')
            ->paginate(20);

        $workers = Worker::query()
            ->select('id', 'nickname')
            ->get();

        $worker = [];

        foreach ($workers as $item){
            $worker[$item->id] = $item->nickname;
        }
//        dd($worker);
        return view('blog.category-detail', compact('datas', 'category', 'worker'));
    }
}
