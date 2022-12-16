<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Composition;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CompositionStatisticsController extends Controller
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
            $routes[$worker->id] = route('comp.worker.detail', $worker->id);
        }

        return view('compositions.workers', compact('workers', 'routes'));
    }

    public function workerDetail(Request $request, $id)
    {
        $worker = Worker::query()
            ->find((int)$id);

        $workersListRoute = route('comp.workers');

        $begin = Carbon::parse($request->start)->startOfDay();
        $end = Carbon::parse($request->end)->endOfDay();

        $datas = Composition::query()
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
            ->select('id', 'title_ru','title_tm', 'views as view_count', 'status', 'date_added as created_at')
            ->with('viewsDetail')
            ->orderBy('date_added', 'desc')
            ->paginate(15);

        session()->flashInput($request->input());

        $url = "compositions";

        return view('compositions.worker-detail', compact('datas', 'worker', 'workersListRoute', 'url'));
    }

    public function categoriesList()
    {
        $categories = Category::query()
            ->where('status', 1)
            ->where('parent_id', '!=', null)
            ->where('parent_id', 355)
            ->orderByDesc('parent_id')
            ->orderBy('name_ru', 'asc')
            ->select('id', 'name_ru as name', 'parent_id')
            ->with('getParent:id,name_ru')
            ->get();

        $controller = 'comp';

        return view('compositions.categories', compact('categories', 'controller'));
    }

    public function categoryDetail(Request $request, Category $category)
    {
        $begin = Carbon::parse($request->start)->startOfDay();
        $end = Carbon::parse($request->end)->endOfDay();

        // get posts
        $datas = Composition::query()
            ->when($request->start, function ($q) use ($begin){
                $q->whereDate('date_added', '>=', $begin);
            })
            ->when($request->end, function ($q) use ($end){
                $q->whereDate('date_added', '<=', $end);
            })
            ->where('category_id', $category->id)
            ->select('id', 'title_ru', 'title_tm', 'views', 'status', 'date_added as created_at', 'worker_ru', 'worker_tm', 'worker_en')
            ->with('viewsDetail')
            ->orderByDesc('date_added')
            ->get();

        // counts the number of posts
        $posts = [
            'tm'    => 0,
            'ru'    => 0,
            'en'    => 0
        ];

        foreach ($datas as $data){
            $posts['tm'] += ($data->title_tm != null);
            $posts['ru'] += ($data->title_ru != null);
            $posts['en'] += ($data->title_en != null);
        }

        // paginate dates
        $datas = $datas->paginate(20);

        $workers = Worker::query()
            ->select('id', 'nickname')
            ->get();

        $worker = [];

        foreach ($workers as $item){
            $worker[$item->id] = $item->nickname;
        }

        $url = "https://turkmenportal.com/compositions/";

        $backUrl = route('comp.categories');

        return view('compositions.category-detail', compact('datas', 'category', 'worker', 'url', 'backUrl', 'posts'));
    }

    public function guide()
    {
        $controller = 'comp';
        return view('guide', compact('controller'));
    }
}
