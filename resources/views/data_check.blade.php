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
        <h2>{{$thread_name}}</h2>
        <div class='page_order'>
            {{$start_num}}番から{{$end_num}}番を表示<br>
        </div>
        <a href="{{ url()->current()}}?start_num={{$end_num}}"><h4>最新のレスを表示</h4></a>
        <div class='response_list'>
            @foreach ($data as $item)
            <p class="aahub_light">{{ $loop->iteration+$start_num-1 . ". " }}<span>{{ $item->content }}</span></p>
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
    </div>
</body>
</html>