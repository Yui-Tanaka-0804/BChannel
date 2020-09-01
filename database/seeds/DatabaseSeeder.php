<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        factory(App\User::class)->create();

        $nullpo_id = DB::table('bot_speaks')->insertGetId([
            'command' => "ぬるぽ",
            'content' => "ｶﾞｯ",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $hiyoko_id = DB::table('bot_speaks')->insertGetId([
            'command' => "ひよこ",
            'content' => "　　　　　　　,-'\"ヽ　　　　
　　　　　　/　　　i､　 　 　　　／￣￣　ヽ, 　　　　　＿/＼／＼/＼／|＿ 　
　　　　　　{ ﾉ　　　\"' ゝ 　　 /　　　　　 　 ', 　　　　＼　　　　　　　　　　／
　　　　　 ／　　 　 　　\"' ゝﾉ　{0}　 /¨`ヽ{0}　　　　 ＜　ニャーン！！　＞
　　　 　 /　　　　　　　　　　　　　　ヽ._.ノ　　', 　　　／　 　　　　　　　　＼ 　　　　　　
　　　 　i 　　　　　　　 　　　　　 　｀ー'′　 '.　　　　￣|／＼/＼/＼/￣　　　　　　　
　　　　/ 　　　　　　　 　 　 　　　　　　　　 　}. 　　　　　　　　　
　　　 i'　　　 /､　 　　　　　　 　　　 　　　　,i..　　　　　　　　　　
　　　 い _／　 `-､.,,　　　　　､_　　　　　　　i　　　　　　　　　　
　　 /'　/ 　 　 _/　 ＼`i　　　\"　　　/ﾞ　　 ./　　　　　　　　　　
　 (,,／ 　 　 , '　 _,,-'\"　i　 ヾi__,,,...--t'\"　 ,|　　　　　　　　　　　
　　　　　　 ,/　／　 　 　＼　 ヽ､　　　i　　|　　　　　　　　　　　
　　　　　　 (､,,/　　　　　　 〉､ ､,}　　　 |　 .i　　　　　　　　　　
　　　　　　　　　　　　　 　 `` `　　　　　! ､､＼　　　　　　　　　　
　　　　　　　　　　　　　　 　　　　　　　　!､_n_,〉>

　 　　　　　　　　　　　　　　　.,,......、
　　　 ＿､　　　_　　　　　　　　 ヽ ｀'i　,‐..,　　　　　　＿＿＿,,,,,,,、
　 '|ﾆ- ／ 　　!│　　　　　　　　,!　 ﾞ'\"　　l　　　　　l　　ﾞ　　　　ﾞl,　
　　 ././　　　 .! ヽ　　　　　　　　!　 ,i--'\"゛　　　　　ﾞ'''\"'''/　 ,,r'''”
　　 l .!　　　　 ! l ＼ 　　　　_,,,,,,,）　 |　　　　　　　　　,, 　｀ﾞ‐'゜
　　 ! |　　　　/ |　ヽ`　　 ／..,,,,,_.　　 ｀''-､　　　　　,┘ﾞ,k　
　　 ヽゝ-__-‐'ﾉ　　　　　 | .'(＿_./ 　.,、　 ｀'､.　　　|　 '{,,＿__,,,,,,,,､.〟
　　　　─‐'''´　　　　　　　ヽ,、　　 _./ ｀'-､,,ﾉ .　　 'ｖ,_　 ￣｀　　: ,,,l
　　　　　　　　　　　　　　　　 .￣´　　 　　　　　　　　　.ﾞ~ﾟ'冖''''\"'ﾞ”″",
            'created_at' => now(), 
            'updated_at' => now(), 
        ]);

        DB::table('command_availables')->insert([
            [
                'command_id' => $hiyoko_id,
                'thread_id' => 0,
                'created_at' => now(), 
                'updated_at' => now(), 
            ],
            [
                'command_id' => $nullpo_id,
                'thread_id' => 0,
                'created_at' => now(), 
                'updated_at' => now(), 
            ],
        ]);
    }
}
