<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>スレッド（テスト） - Bちゃんねる</title>

    <!-- PWA -->
    <link rel="manifest" href="/manifest.json">
    <script src="{{ asset('/js/pwa.js') }}"></script>
</head>
<style>
    html, body{
        background-color: blanchedalmond;
    }
    
    .response {
        border: dashed 1px grey;
        margin-bottom: 1em;
        padding: 0.3em;
        background-color: ivory;
    }

    .response_content {
        padding-left:1.3em;
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
        <h2>{{$thread_name}}</h2>
        <div class='page_order'>
            {{$start_num}}番から{{$end_num}}番を表示<br>
        </div>
        <a href="{{ url()->current()}}?start_num={{$end_num}}"><h4>最新のレスを表示</h4></a>
        <div class='response_list'>
            @foreach ($data as $item)
            <div class='response'>
                <div class='response_date'>{{ $loop->iteration+$start_num-1 . ". " . $item->updated_at}}</div>
                <div class='response_content aahub_light'>{{ $item->content }}</div>
            </div>
            @endforeach
        </div>
        <a href="{{ url()->current()}}?start_num={{$end_num}}"><h4>最新のレスを表示</h4></a>
        <div class='post_response'>
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
        <div class='post_command'>
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
    </div>
</body>
</html>