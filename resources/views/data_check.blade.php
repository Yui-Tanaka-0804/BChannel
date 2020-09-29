@extends('layouts.header')

@section('meme')
<!-- やあ （´・ω・｀)
ようこそ、バーボンハウスへ。
このテキーラはサービスだから、まず飲んで落ち着いて欲しい。

うん、「また」なんだ。済まない。
仏の顔もって言うしね、謝って許してもらおうとも思っていない。

でも、このソースコードを見たとき、君は、きっと言葉では言い表せない「ときめき」みたいなものを感じてくれたと思う。
殺伐とした世の中で、そういう気持ちを忘れないで欲しい
そう思って、このサイトを作ったんだ。

じゃあ、注文を聞こうか。 -->
@endsection

@section('title')
<title>{{$thread_name}} - Bちゃんねる</title>
@endsection

@section('content')
        <h2>{{$thread_name}}</h2>
        <div class='page_order'>
            {{$start_num}}番から{{$end_num}}番を表示<br>
        </div>
        <h4><a href="{{ url()->current()}}?start_num={{$end_num}}">最新のレスを表示</a></h4>
        <div class='response_list'>
            @foreach ($data as $item)
            <div class='response'>
                <div class='response_date'>{{ $loop->iteration+$start_num-1 . ". " . $item->updated_at}}</div>
                <div class='content'>
                    <span class='aahub_light'>{{ $item->content }}</span>
                </div>
            </div>
            @endforeach
        </div>
        <h4><a href="{{ url()->current()}}?start_num={{$end_num}}">最新のレスを表示</a></h4>
        <div class='response'>
            <form action="{{ url()->current() }}" method="POST">
                {{ csrf_field() }}
                <div>
                    <textarea name="content" class="aahub_light"></textarea>
                </div>
                <div>
                    <input type="submit" value="投稿" />
                </div>
            </form>
        </div>
        <div class='response'>
            <form action="/bot-command" method="POST">
                {{ csrf_field() }}
                <div>
                    <p>コマンド登録</p>
                    <input type="hidden" name="thread_id" value="{{ request()->path() }}">
                    <div>コマンド：<input type="text" name="command" /></div>
                    <div>本文：<textarea name="content" class="aahub_light"></textarea></div>
                    <div>
                        <input type="submit" value="登録" />
                    </div>
                </div>
            </form>
        </div>
@endsection