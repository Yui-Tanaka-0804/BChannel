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
    public function index($thread_name)
    {
        $res = \App\Response::All();
        $page_num = $res->count();
        
        return view('data_check', ['thread_name'=>$thread_name, 'data'=>$res, 'start_num'=>1, 'end_num'=>$page_num]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, String $thread_name)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $res = new \App\Response;
        $res->content = $request->content;
        $res->save();
        return redirect($thread_name);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Response  $response
     * @return \Illuminate\Http\Response
     */
    public function show(String $thread_name, String $id)
    {
        $id = explode("-", $id, 2);
        $res = \App\Response::whereBetween('id', [$id[0], $id[1]])->get();
        return view('data_check', ['thread_name'=>$thread_name, 'data'=>$res, 'start_num'=>$id[0], 'end_num'=>$id[1]]);
    }
}
