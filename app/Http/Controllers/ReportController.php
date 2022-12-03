<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Worker;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function workersList()
    {


        $workers = Worker::query()
            ->select('id', 'firstname as name', 'lastname as surname')
            ->orderBy('lastname')
            ->orderBy('firstname')
            ->get();

        return view('report.worker', compact('workers'));

    }

    public function workerDetail(Request $request, $id)
    {

        $worker = Worker::query()
            ->find((int)$id);



        $blogs = Blog::query()
            ->when($request->start, function ($q, $v){
                $q->where('date_added', '>=', $v);
            })
            ->when($request->end, function ($q, $v){
                $q->where('date_added', '<=', $v);
            })
            ->where('worker_ru',  $worker->id)
            ->orWhere('worker_tm', '=', $worker->id)
            ->orWhere('worker_en', '=', $worker->id)
            ->select('id', 'title_ru','title_tm', 'visited_count as view_count', 'status', 'date_added as created_at')
            ->with('viewsDetail')
            ->orderBy('date_added', 'desc')
            ->paginate(15);

        $count = Blog::query()
            ->where('worker_ru',  $worker->id)
            ->orWhere('worker_tm', '=', $worker->id)
            ->orWhere('worker_en', '=', $worker->id)
            ->count();

        session()->flashInput($request->input());

        return view('report.worker-detail', compact('blogs', 'count', 'worker'));
    }
}
