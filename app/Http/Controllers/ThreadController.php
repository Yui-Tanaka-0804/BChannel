<?php

namespace App\Http\Controllers;

use App\Thread;
use App\Response;
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
            'content' => 'required'
        ]);

        $thread = new thread;
        $thread->name = $request->name;
        $thread->save();
        
        $response = new Response;
        $response->content = $request->content;
        $thread->responses()->save($response);

        return redirect("/");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function destroy(Thread $thread, int $thread_id)
    {   
        Thread::destroy($thread_id);
        return redirect("/");
    }
}
