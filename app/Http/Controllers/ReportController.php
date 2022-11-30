<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Worker;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function worker()
    {
        $data = [];

        $workers = Worker::query()
            ->select('id', 'firstname', 'lastname')
            ->orderBy('lastname')
            ->orderBy('firstname')
            ->get();


        foreach ($workers as $item => $worker){

            $data[] = [
                'id'            => $worker->id,
                'name'          => $worker->firstname,
                'surnename'     => $worker->lastname,
                'post_count'    => Blog::query()
                                        ->where('worker_ru', $worker->id)
//                                        ->orWhere('worker_tm', $worker->id)
//                                        ->orWhere('worker_en', $worker->id)
                                        ->count(),
            ];

            var_dump($data[$item]);
        }
        dd($data);

    }
}
