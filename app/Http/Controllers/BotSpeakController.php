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
        ]);

        $res = new \App\BotSpeak;
        $res->command = $request->command;
        $res->content = $request->content;
        $res->save();
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
        return redirect("/bot-command");
    }
}
