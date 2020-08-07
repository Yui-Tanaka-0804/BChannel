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
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>コマンド一覧 - Bちゃんねる</title>

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

    @font-face {
        font-family: "aahub_light";
        src:
            url("{{ url('/font/aahub_light.woff2') }}") format("woff2"),
            url("{{ url('/font/aahub_light.woff') }}") format("woff"),
            url("{{ url('/font/aahub_light.ttf') }}") format("ttf");
        font-display: swap;
    }

    .aahub_light {
        font-family: "aahub_light";
        white-space: pre;
        font-size: 16px;
        line-height: 18px;
    }
</style>
<body>
    <div class="container">
        <a href="{{ url('') }}"><h1>Bちゃんねる</h1></a>
        <h2>コマンド一覧</h2>
        <div>@foreach ($data as $item)

            <form action="/bot-command/{{ $item->id }}" method="POST">
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
    </div>
</body>
</html>