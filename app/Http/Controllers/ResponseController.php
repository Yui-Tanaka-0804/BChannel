<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Events\PostBotAction;

class ResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, int $thread_id)
    {
        $validator = Validator::make($request->query(),[
            'start_num' => 'regex:/^[1-9][0-9]*$/',
            'end_num' => 'regex:/^[1-9][0-9]*$/',
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $thread_name = \App\Thread::where('id', $thread_id)->first()->name;
        $res_count = \App\Response::where('thread_id', $thread_id)->count();

        $start_num = (int)$request->input('start_num', 1); 
        $end_num = (int)$request->input('end_num', $res_count); // end_numの指定が無い場合は件数を取得して代入する

        // 指定されたレスがまだ無い or 指定番号が0以下 or startがendの値を超えている場合は前ページにリダイレクト
        if ($start_num < 1 || $start_num > $res_count || $end_num < 1 || $end_num > $res_count
            || $start_num > $end_num) {
            return back()->withErrors($validator)->withInput();
        }

        $res = \App\Response::where('thread_id', $thread_id)->skip($start_num-1)->take($end_num-$start_num+1)->get(['content', 'updated_at']);

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

        // 以下はbotの処理
        $content = $res->content;
        if (substr($content, 0, 1) == "/") {
            $thread_id = $res->thread_id;

            $explode_str = explode(" ",$content,2);
            $command = ltrim($explode_str[0], '/');

            event(new PostBotAction($thread_id, $command));
        }

        return back();
    }
}
