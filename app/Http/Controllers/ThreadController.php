<?php

namespace App\Http\Controllers;

use App\Thread;
use Illuminate\Http\Request;

class ThreadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $thread = Thread::simplePaginate(10);
        $thread_num = $thread->count();
        
        return view('thread_index', ['data'=>$thread, 'thread_num'=>$thread_num]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $res = new thread;
        $res->name = $request->name;
        $res->save();
        return redirect("/");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function destroy(Thread $thread, $thread_id)
    {
        // 数字以外を通して爆発させてしまったので修正
        if(!(is_numeric($thread_id))){
            return redirect('/');
        }

        if (\App\Thread::where('id', $thread_id)->doesntExist()) {
            return redirect('/');
        }
        
        Thread::destroy($thread_id);
        return redirect("/");
    }
}
