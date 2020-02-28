
## 作業日記
この日誌書くのでわりと時間使ってるので評価材料として見てもらえると嬉しいです・・・
### 1日目
ネタ作り。Slack内に某匿名掲示板を作るという記事があったのを思い出したので、**掲示板を作る**方向で決定。とりあえず以前投げっぱなしジャーマン決めて放置したミドルウェアをきちんと作成することを目標に決めた。あとbot。テストはちゃんと組む。
### 2日目
環境構築した。とりあえずWSLに直乗せした。余った時間でDB少し作った。自動生成に任せたらファクトリーとか出てきたのでちゃんと作ることにした。
### 3日目
**「これミドルウェア関係なくない…？」** ってことで目標変更。**テスト組む**のを目標にした。もはや研究サイド。そしてこれ書きながらコメント書いてないの思い出した。これ以降はちゃんと書きます。
*  `Expected status code 200 but received 500.` 一覧ページがbrowser上は動いてるのにテストだと動かない。→原因はDB内がリセットされて、データがなくて表示時にエラー吐いてたから。なのでデータ突っ込もうとしたらめっちゃエラー吐いて進まなくなった。そして時間切れ。
### 4日目
`testing.ERROR: could not find driver (SQL: PRAGMA foreign_keys = ON;) ` テスト動かん。dev環境はmysqlでやってるけど、phpunitではデフォルトでsqliteを指定してあるのが原因かと。→sqlite、Ubuntuに入ってた。じゃあ設定が悪いってことか。→デフォルトではsqliteのメモリ機能を使ってうまく動くように組まれてるらしいが如何せん設定がうまくいかない。諦めてmysqlを使うように修正する。phpunit.xmlでmysqlを指定、データベースを追加で作成(DB名は`testing`)→エラー内容が変わった。テーブルが無いというエラーなので`php artisan migrate`に相当する関数を追加→methodがないと思ったら`use PHPUnit\Framework\TestCase`になってた。`use Tests\TestCase`に修正→エラーが残り１つまで減った。testing.responseがない。はて、さっきまでのエラーではtesting.response**s**だった気がしたが…→綴り間違いですね…修正したらエラー消えました。お疲れさまでした。（※まだまだこれから）
* コントローラーからいらないメソッドを消した。残りのやつはまた火曜日に。
### 5日目
コントローラーの中身書いてテストコードもめっちゃ書いた。
* リダイレクトしたらhtmlの中身が`redirect to ...`みたいになってた。インデックス画面のhtmlください。DBはリセットされてないのでもう一回getしてテストしたらうまく動いた。
* 残り２日でレイアウト投げ捨ててスレッド周りの機能追加とテストコード実装すれば終わり。行けるのでは？？？
### 6日目
* いい感じ。何やったっけ。スレッド追加した。残り時間で削除したら連携して中のレスも消えるようにした。スレッドの一覧がページ分かれる。すごい。テストもめっちゃ書いた。時間無い。あんぱん。
* レスにスレッドのID追加するコードを書いてないので動かない。テストも書いてない。紙も書いてない。やべぇ。
### 7日目
* あんぱんもいいけどアンバターもすき。掲示板動いた。存在しないスレッドにつなぐとトップに戻る。紙かいてない。これコピペで貼ってもいいかな。掲示板に。
* テストが動かない。テスト用のDBが思ったように動かない。ちくわ大明神。誰だお前は。動かないけどこんなことしてますってことで消さずにおいておく。解決策誰か教えてください。切実に。
* <h2> Laravel Duskの存在を忘れてました！！！俺の負け！！！対戦ありがとうございました！！！</h2>
### 8ﾆﾁﾒ
突然の試合延長に困惑しております。どうも私です。どうせなので、スレッドの伸びが分かるようにレスの件数を表示できるようにしたいと思います。はい、よーいスタート。
* 終了。post送信用の認証タグをいじってた所為で419エラー吐かれたときはめちゃくちゃ焦った。あとはデザインいじる。--再開--
* レス番号の指定を決まった書き方以外でやると爆発することに気づいてしまった。こっちの修正が優先だわ。--あんぱん--
* 修正完了。`$thread_id`を引数にとるメソッド全てに`is_numeric()`を噛ませて対応。ほんとはmiddlewareに書いて一括で処理できるようにしたいけど時間が足りない。--終了--
* --時間余った--レスの改行が表示に反映されない状態になっていたのでいい感じに修正。`word-wrap: break-word; white-space: pre-wrap;`ここ好き。`<br>`タグ仕込まなくてもいい感じに改行してくれるネ申コード。
* レス番指定動かんとか名前表示してないとか修正した。

# Bちゃんねるについて
掲示板です。スレッドを立てて、その中に書き込みができます。書き込んだ内容は消えません。スレッドごと闇に葬り去ることはできます。スレッドが１０件を超えると次のページが増えます。urlの後ろに`/1-3`などをつけると指定したレスだけ表示します。以上です。

# テストの自動化
この作品が動くかどうかをテストするために、テストの自動化ツールを作成しました。phpunitというデフォルトでlaravelについてくるツールを使用しました。
* ブラウザ上でできることなら大体何でもできます。ボタンクリックとかも再現してテストしてくれるらしいです。私は知りませんでした。
* 主にDB操作のチェックやページ遷移の状態のチェックを中心にテストを自動化しています。
* これの作成に授業時間の半分を割いています。
* 本来の用途は**テストを自動化することによって後々のテスト工程の簡略化、チーム制作の際の利便性向上**ですが、今回は短期間かつ１人での制作だったのであまり効果は出ていません。ですが、潜在的なバグを見つけることに一役買ってくれたシーンもあったので、全くの無駄ではなかったと感じています。

---

<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[British Software Development](https://www.britishsoftware.co)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- [UserInsights](https://userinsights.com)
- [Fragrantica](https://www.fragrantica.com)
- [SOFTonSOFA](https://softonsofa.com/)
- [User10](https://user10.com)
- [Soumettre.fr](https://soumettre.fr/)
- [CodeBrisk](https://codebrisk.com)
- [1Forge](https://1forge.com)
- [TECPRESSO](https://tecpresso.co.jp/)
- [Runtime Converter](http://runtimeconverter.com/)
- [WebL'Agence](https://weblagence.com/)
- [Invoice Ninja](https://www.invoiceninja.com)
- [iMi digital](https://www.imi-digital.de/)
- [Earthlink](https://www.earthlink.ro/)
- [Steadfast Collective](https://steadfastcollective.com/)
- [We Are The Robots Inc.](https://watr.mx/)
- [Understand.io](https://www.understand.io/)
- [Abdel Elrafa](https://abdelelrafa.com)
- [Hyper Host](https://hyper.host)
- [Appoly](https://www.appoly.co.uk)
- [OP.GG](https://op.gg)

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
