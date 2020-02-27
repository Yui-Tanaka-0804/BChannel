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
    public function index($thread_id)
    {
        $res = \App\Response::where('thread_id', $thread_id)->get(['content']);
        $res_num = $res->count();

        // 0件の時に表示が「1-0」のようになってしまうので対処
        if ($res_num < 1) {
            $res_num = 1;
        }
        
        return view('data_check', ['thread_id'=>$thread_id, 'data'=>$res, 'start_num'=>1, 'end_num'=>$res_num]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, String $thread_id)
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Response  $response
     * @return \Illuminate\Http\Response
     */
    public function show(String $thread_id, String $id)
    {
        $id = explode("-", $id, 2);
        $res = \App\Response::whereBetween('id', [$id[0], $id[1]])->get();
        return view('data_check', ['thread_id'=>$thread_id, 'data'=>$res, 'start_num'=>$id[0], 'end_num'=>$id[1]]);
    }
}
