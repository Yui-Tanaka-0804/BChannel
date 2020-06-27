<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, int $thread_id)
    {
        $thread_name = \App\Thread::where('id', $thread_id)->first()->name;
        $res_count = \App\Response::where('thread_id', $thread_id)->count();

        $start_num = (int)$request->input('start_num', 1); 
        $end_num = (int)$request->input('end_num', $res_count); // end_numの指定が無い場合は件数を取得して代入する

        $res = \App\Response::where('thread_id', $thread_id)->skip($start_num-1)->take($end_num-$start_num+1)->get(['content']);

        return view('data_check', ['thread_name'=>$thread_name, 'thread_id'=>$thread_id, 'data'=>$res, 'start_num'=>$start_num, 'end_num'=>$end_num]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, int $thread_id)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $res = new \App\Response;
        $res->thread_id = $thread_id;
        $res->content = $request->content;
        $res->save();
        return redirect($thread_id);
    }
}
