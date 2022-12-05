<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ReportController extends Controller
{
    public function workersList()
    {


        $workers = Worker::query()
            ->select('id', 'firstname as name', 'lastname as surname')
            ->orderBy('lastname')
            ->orderBy('firstname')
            ->get();

        return view('report.workers-list', compact('workers'));

    }

    public function workerDetail(Request $request, $id)
    {
        $worker = Worker::query()
            ->find((int)$id);

        $begin = Carbon::parse($request->start)->startOfDay();
        $end = Carbon::parse($request->end)->endOfDay();

        $blogs = Blog::query()
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

        return view('report.worker-detail', compact('blogs', 'worker'));
    }
}
