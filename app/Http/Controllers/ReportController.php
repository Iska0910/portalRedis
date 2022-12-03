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

    public function workerDetail($id)
    {
        $worker = (int)$id;

        $blogs = Blog::query()
            ->where('worker_ru',  $worker)
            ->orWhere('worker_tm', '=', $worker)
            ->orWhere('worker_en', '=', $worker)
            ->select('id', 'title_ru','title_tm', 'visited_count')
            ->with('viewsDetail')
            ->orderBy('date_added', 'desc')
            ->paginate(15);

        $count = Blog::query()
            ->where('worker_ru',  $worker)
            ->orWhere('worker_tm', '=', $worker)
            ->orWhere('worker_en', '=', $worker)
            ->count();

        return view('report.worker-detail', compact('blogs', 'count'));
    }
}
