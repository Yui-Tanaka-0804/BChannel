<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>スレッド（テスト） - Bちゃんねる</title>
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
        <a href="{{ url('') }}"><h1>Bちゃんねる</h1></a>
        <h2>{{$thread_name}}</h2>
        <div class='page_order'>
            {{$start_num}}番から{{$end_num}}番を表示<br>
            urlの後ろに/1-3などをつけると指定したレスだけ表示します。<br>
            最新だけ表示は間に合いませんでした。すまんな。
        </div>
        <a href="{{ url()->current() }}"><h4>更新</h4></a>
        <div class='response_list'>
            @foreach ($data as $item)
            <p>{{ $loop->iteration+$start_num-1 . ". " . $item->content }}</p>
            @endforeach
        </div>
    <a href="{{ url()->current() }}"><h4>更新</h4></a>
        <div class='post_response'>
            <form action="{{ url()->current() }}" method="POST">
                {{ csrf_field() }}
                <div>
                    <textarea name="content"></textarea>
                </div>
                <div>
                    <input type="submit" value="投稿" />
                </div>
            </form>
        </div>
    </div>
</body>
</html>