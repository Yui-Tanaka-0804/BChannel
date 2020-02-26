<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>スレッド（テスト） - Bちゃんねる</title>
</head>
<body>
    <div class="container">
        <h1>Bちゃんねる</h1>
        <div class='page_order'>
            {{$start_num}}番から{{$end_num}}番を表示
        </div>
        <div class='response_list'>
            @foreach ($data as $item)
            <p>{{ $item->id . ". " . $item->content }}</p>
            @endforeach
        </div>
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