
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
