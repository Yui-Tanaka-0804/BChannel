<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>スレッド一覧 - Bちゃんねる</title>
</head>
<body>
    <div class="container">
        <h1>Bちゃんねる</h1>
        <h2>スレッド一覧</h2>
        @foreach ($data as $item)
        <form action="/{{ $item->id }}" method="POST">
            {{ csrf_field() }}
            @method('DELETE')
            <p>{{ $item->id . ". " }}<a href="{{ url()->current() . "/" . $item->id }}">{{ $item->name }}</a> <input type="submit" value="削除" /></p>
        </form>
        @endforeach
        
        {{ $data->links() }}
        
        <div class='post_response'>
            <form action="/" method="POST">
                {{ csrf_field() }}
                <div>
                    スレッド作成：
                    <input type="text" name="name" />
                    <input type="submit" value="追加" />
                </div>
            </form>
        </div>
    </div>
</body>
</html>