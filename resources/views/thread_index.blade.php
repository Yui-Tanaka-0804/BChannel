<!-- やあ （´・ω・｀)
ようこそ、バーボンハウスへ。
このテキーラはサービスだから、まず飲んで落ち着いて欲しい。

うん、「また」なんだ。済まない。
仏の顔もって言うしね、謝って許してもらおうとも思っていない。

でも、この項目を見たとき、君は、きっと言葉では言い表せない「ときめき」みたいなものを感じてくれたと思う。
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
</head>
<body>
    {{ csrf_field() }}
    <div class="container">
        <a href="{{ url()->current() }}"><h1>Bちゃんねる</h1></a>
        <h2>スレッド一覧</h2>
        @foreach ($data as $item)
        <form action="/{{ $item->id }}" method="POST">
            @method('DELETE')
            <p>{{ $loop->iteration . ". " }}<a href="{{ url()->current() . "/" . $item->id }}">{{ $item->name }}</a> <input type="submit" value="削除" /></p>
        </form>
        @endforeach
        
        {{ $data->links() }}
        
        <div class='post_response'>
            <form action="/" method="POST">
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