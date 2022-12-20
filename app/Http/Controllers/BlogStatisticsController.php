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
            ->select('id', 'title_ru','title_tm', 'category_id', 'visited_count as view_count', 'status', 'date_added as created_at')
            ->with('viewsDetail')
            ->orderBy('date_added', 'desc')
            ->get();


        $categories['category'] = $this->getCategories();

        foreach ($datas as $data){

            if (isset($categories['count'][$data->category_id]))
                $categories['count'][$data->category_id]++;
            else
                $categories['count'][$data->category_id] = 1;

        }

        $datas = $datas->paginate(20);

        session()->flashInput($request->input());

        $url = "blog";

        return view('blog.worker-detail', compact('datas', 'worker', 'workersListRoute', 'url', 'categories'));
    }

    protected function getCategories()
    {
        $categories = Category::query()
            ->where('status', 1)
            ->where('parent_id', '!=', null)
            ->where(function($q){
                $q->Where('parent_id', 282)
                    ->orWhere('parent_id', 338)
                    ->orWhere('parent_id', 430);
            })
            ->select('id', 'name_ru', 'name_tm')
            ->orderBy('name_ru', 'asc')
            ->get();

        $data = [];
//        eaecef
        foreach ($categories as $category){
            if ($category->name_ru != null)
                $data[$category->id] = $category->name_ru;
            else
                $data[$category->id] = $category->name_tm;
        }

        return $data;
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

    public function categoryDetail(Request $request, Category $category)
    {
        $begin = Carbon::parse($request->start)->startOfDay();
        $end = Carbon::parse($request->end)->endOfDay();
        $worker_id = null;

        if ($request->worker > 0)
            $worker_id = $request->worker;

        // get posts
        $datas = Blog::query()
            ->when($request->start, function ($q) use ($begin){
                $q->whereDate('date_added', '>=', $begin);
            })
            ->when($request->end, function ($q) use ($end){
                $q->whereDate('date_added', '<=', $end);
            })
            ->where('category_id', $category->id)
            ->when($worker_id, function ($query, $v){
                $query->where(function ($q) use ($v){
                    $q->where('worker_ru', $v)
                        ->orWhere('worker_tm', $v)
                        ->orWhere('worker_en', $v);
                    });
            })
            ->select('id', 'title_ru', 'title_tm', 'title_en', 'visited_count as views', 'status', 'date_added as created_at', 'worker_ru', 'worker_tm', 'worker_en', 'researcher_tm', 'researcher_ru', 'researcher_en')
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

        $url = "https://turkmenportal.com/blog/";

        $backUrl = route('blog.categories');

        session()->flashInput($request->input());

        return view('blog.category-detail', compact('datas', 'category', 'worker', 'url', 'backUrl', 'category', 'posts'));
    }

    public function guide()
    {
        $controller = 'blog';
        return view('guide', compact('controller'));
    }
}
