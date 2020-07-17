<?php

namespace App\Listeners;

use App\Events\PostBotAction;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PostBotActionNotification implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  PostBotAction  $event
     * @return void
     */
    public function handle(PostBotAction $event)
    {
        $thread_id = $event->thread_id;
        $command = $event->command;

        // 以下はbotの処理
            if ($command == "ぬるぽ") {
                $res = new \App\Response;
                $res->thread_id = $thread_id;
                $res->content = "ｶﾞｯ";
                $res->save();
            }
            else if ($command == "ひよこ") {
                $res = new \App\Response;
                $res->thread_id = $thread_id;
                $res->content = "
　　　　　　　,-'\"ヽ　　　　
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
　　　　　　　　　　　　　　　　 .￣´　　 　　　　　　　　　.ﾞ~ﾟ'冖''''\"'ﾞ”″
                ";
                $res->save();
            }
    }
}
