<!-- やあ （´・ω・｀)
ようこそ、バーボンハウスへ。
このテキーラはサービスだから、まず飲んで落ち着いて欲しい。

うん、「また」なんだ。済まない。
仏の顔もって言うしね、謝って許してもらおうとも思っていない。

でも、このソースコードを見たとき、君は、きっと言葉では言い表せない「ときめき」みたいなものを感じてくれたと思う。
殺伐とした世の中で、そういう気持ちを忘れないで欲しい
そう思って、このサイトを作ったんだ。

じゃあ、注文を聞こうか。 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>スレッド一覧 - Bちゃんねる</title>

    <!-- PWA -->
    <link rel="manifest" href="/manifest.json">
    <script src="{{ asset('/js/pwa.js') }}"></script>
</head>
<style>
    html, body{
        background-color: blanchedalmond;
    }

    p {
        word-wrap: break-word;
        white-space: pre-wrap;
        padding-left:1.3em;
        text-indent:-1.3em;
    }
</style>
<body>
    <div class="container">
        <a href="{{ url()->current() }}"><h1>Bちゃんねる</h1></a>
        <a href="{{ url()->current() . "/bot-command" }}">コマンド一覧</a>
        <h2>スレッド一覧(<a href="{{ url()->current() }}">更新</a>)</h2>
        @foreach ($data as $item)
        <p>{{ $loop->iteration-1 + $data->firstItem() . ". " }}<a href="{{ url()->current() . "/" . $item->id }}">{{ $item->name }}</a>{{"(".$item->responses_count().")"}}</p>
        @endforeach
        
        {{ $data->links() }}
        
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
    </div>
</body>
</html>