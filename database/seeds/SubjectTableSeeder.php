<?php

use App\Subject;
use Illuminate\Database\Seeder;

class SubjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subjects = [
            [
                'subject' => 'Laravel 6.0 初體驗！怎麼用最新的 laravel 架網站！',
                'posts' => [
                    '[Day 1] 開始使用 Laravel 6.0',
                    '[Day 2] 版本怎麼不是 6.0？聊聊版本編號與 Laravel 架構',
                    '[Day 3] 框架裝好了，那畫面呢？聊環境建置，docker 和 laradock'
                ],
                'tags' => ['PHP', 'IT', '後端']
            ],
            [
                'subject' => '紐時記者4個城市被隔離 驚嘆「看到台灣為何被稱讚」',
                'posts' => [
                    '如果兩方都賴著不賠 那要找誰要',
                    '事實上,中國之所以不能讓台灣進入WHO,是因為無法對世界各國進行生化戰,沒看到台灣能在第一時間就發覺中國的傳染病現狀,馬上採取行動,而所有的歐美日俄國家,都還沉醉在WHO的麻痺說詞裡,然後中國可以去各國搜刮醫療物資,讓各國在傳染病到達時,根本就毫無招架之力,當台灣已經從傳染病壓力解放時,各國還深陷傳染病的高峰,甚至要迎來第二波高峰,這時WHO做甚麼事能夠避免,甚至免除? 甚麼都不做,還要等著拿錢,這是最可恥的事情了,最終WHO當然不會讓台灣進入,否則中國要如何做對各國的生化戰爭?',
                    '109.5.13我到桃園地政事務所測量課想要再次申請中正段1170-1重測調查表及補正表，請他們給我同比例A3尺寸，因107年我第一次到測量課游松源先生給我中正段1171重測調查表與補正表都是A3同比例。'
                ],
                'tags' => ['社會', '財經']
            ]
        ];

        foreach($subjects as $key => $sub) {
            $existSub = Subject::where('title', '=', $sub['subject'])->first();

            if (!isset($existSub)) {
                $existSub = new App\Subject;
                $existSub->title = $sub['subject'];
                $existSub->save();
            }
        }
    }
}