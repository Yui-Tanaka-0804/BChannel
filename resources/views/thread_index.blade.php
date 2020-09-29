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
<title>Bちゃんねる</title>
@endsection

@section('content')
        <div class="card">
            <div class="card-header">スレッド一覧(<a href="{{ url()->current() }}">更新</a>)</div>

            <div class="card-body response">
                @foreach ($data as $item)
                <p>{{ $loop->iteration-1 + $data->firstItem() . ". " }}<a href="{{ url()->current() . "/" . $item->id }}">{{ $item->name }}</a>{{"(".$item->responses_count().")"}}</p>
                @endforeach
            </div>
            <div class="card-footer">
                {{ $data->links() }}
            </div>
        </div>
        
        
        <div class='post_response'>
            <form action="/" method="POST">
                {{ csrf_field() }}
                <div>
                    <div>
                        スレッド作成：
                        <input type="text" name="name" />
                    </div>
                    <div>
                        本文：
                        <textarea name="content"></textarea>
                    </div>
                    <div>
                        <input type="submit" value="追加" />
                    </div>
                </div>
            </form>
        </div>
@endsection