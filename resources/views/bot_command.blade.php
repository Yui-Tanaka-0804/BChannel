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
<title>コマンド一覧 - Bちゃんねる</title>
@endsection

@section('content')
        <h2>コマンド一覧</h2>
        <div>@foreach ($data as $item)

            <form action="/bot-command/{{ $item->id }}" method="POST" class="response">
                {{ csrf_field() }}
                @method('DELETE')

                <div>{{ $loop->iteration . ". " }}{{ $item->command }} <input type="submit" value="削除" /></div>
                <div>
                    適用範囲：
                    <div>
                        @if ($item->is_available_all())全体
                        @else @foreach ($item->threads()->get(['id', 'name']) as $thread){{ $thread->id . ". " }}<a href="{{ url('/') . "/" . $thread->id }}">{{ $thread->name }}</a>@endforeach @endif
                    </div>
                </div>
                <div>
                    内容：
                    <div>
                        <span class="aahub_light">{{ $item->content }}</span>
                    </div>
                </div>
            </form>@endforeach

        </div>
        <div class='post_command'>
            <form action="/bot-command" method="POST">
                {{ csrf_field() }}
                <div>
                    <div>コマンド登録</div>
                    <input type="hidden" name="thread_id" value="0">
                    <div>
                        コマンド：
                        <input type="text" name="command" />
                    </div>
                    <div>
                        本文：
                        <textarea name="content" class="aahub_light"></textarea>
                    </div>
                    <div>
                        <input type="submit" value="登録" />
                    </div>
                </div>
            </form>
        </div>
@endsection