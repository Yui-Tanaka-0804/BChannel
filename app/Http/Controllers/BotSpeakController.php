<?php

namespace App\Http\Controllers;

use App\BotSpeak;
use Illuminate\Http\Request;

class BotSpeakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = \App\BotSpeak::all();
        
        return view('bot_command', ['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'command' => 'required',
            'content' => 'required',
            'thread_id' => 'numeric',
        ]);

        $command = $request->command;
        $content = $request->content;
        $thread_id = $request->thread_id;

        // 該当するスレッドが存在しない場合はエラー
        // 想定されるパターンは 数値を書き換えた or 操作中にスレッドが削除された
        // なので「エラーが発生しました」と表示してホーム画面に戻す
        if (!($thread_id == 0 || \App\Thread::find($thread_id)->exists())) {
            return back();
        }

        $res = new \App\BotSpeak;
        $res->command = $command;
        $res->content = $content;
        $res->save();
        
        $command_id = $res->id;
        
        $ava = new \App\CommandAvailable;
        $ava->command_id = $command_id;
        $ava->thread_id = $thread_id;
        $ava->save();

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BotSpeak  $botSpeak
     * @return \Illuminate\Http\Response
     */
    public function show(BotSpeak $botSpeak)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BotSpeak  $botSpeak
     * @return \Illuminate\Http\Response
     */
    public function edit(BotSpeak $botSpeak)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BotSpeak  $botSpeak
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BotSpeak $botSpeak)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BotSpeak  $botSpeak
     * @return \Illuminate\Http\Response
     */
    public function destroy(BotSpeak $botSpeak, int $id)
    {
        BotSpeak::destroy($id);
        \App\CommandAvailable::where('command_id', $id)->delete();
        return redirect("/bot-command");
    }
}
