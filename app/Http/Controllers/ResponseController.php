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
        // 数字以外を通して爆発させてしまったので修正
        if(!(is_numeric($thread_id))){
            return redirect('/');
        }

        if (\App\Thread::where('id', $thread_id)->doesntExist()) {
            return redirect('/');
        }

        $thread_name = \App\Thread::where('id', $thread_id)->first()->name;
        $res = \App\Response::where('thread_id', $thread_id)->get(['content']);
        $res_num = $res->count();

        // 0件の時に表示が「1-0」のようになってしまうので対処
        if ($res_num < 1) {
            $res_num = 1;
        }
        
        return view('data_check', ['thread_name'=>$thread_name, 'thread_id'=>$thread_id, 'data'=>$res, 'start_num'=>1, 'end_num'=>$res_num]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, String $thread_id)
    {
        // 数字以外を通して爆発させてしまったので修正
        if(!(is_numeric($thread_id))){
            return redirect('/');
        }

        if (\App\Thread::where('id', $thread_id)->doesntExist()) {
            return redirect('/');
        }

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
        // 数字以外を通して爆発させてしまったので修正
        if(!(is_numeric($thread_id))){
            return redirect('/');
        }

        if (\App\Thread::where('id', $thread_id)->doesntExist()) {
            return redirect('/');
        }

        $id = explode("-", $id, 2);
        $res = \App\Response::where('thread_id', $thread_id)->skip($id[0])->take($id[1]-$id[0]+1)->get();
        return view('data_check', ['thread_id'=>$thread_id, 'data'=>$res, 'start_num'=>$id[0], 'end_num'=>$id[1]]);
    }
}
