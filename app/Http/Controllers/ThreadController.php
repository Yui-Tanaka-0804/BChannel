<?php

namespace App\Http\Controllers;

use App\Thread;
use App\Response;
use Illuminate\Http\Request;
use App\Events\PostBotAction;

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

        $thread_name = $request->name;
        $request_content = $request->content;

        $thread = new thread;
        $thread->name = $thread_name;
        $thread->save();

        $thread_id = $thread->id;

        \Log::info('store Thread.', ["thread_id" => $thread_id, "ip" => $request->ip()]);
        
        $response = new Response;
        $response->content = $request_content;
        $thread->responses()->save($response);


        \Log::info('store Response.', ["thread_id" => $thread_id, "response_id" => $response->id, "ip" => $request->ip()]);

        // 以下はbotの処理
        $content = $response->content;
        if (substr($content, 0, 1) == "/") {
            $explode_str = explode(" ",$content,2);
            $command = ltrim($explode_str[0], '/');

            event(new PostBotAction($thread_id, $command));
        }

        return redirect("/" . $thread_id);
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
        \Log::info('destroy Thread.', ["thread_id" => $thread_id, "ip" => $request->ip()]);
        return back();
    }
}
