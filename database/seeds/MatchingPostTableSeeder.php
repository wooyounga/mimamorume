<?php

use Illuminate\Database\Seeder;

class MatchingPostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $title = ["介護が必要な方を探します", "働きたいです", "資格あります", "介護経歴30年です", "家族のように対します"];

        $age = ["20代", "50代", "40代", "30代", "70代以上"];

        $disability = ["自閉性障害", "肢体障害", "聴覚障害", "顔面障害", "言語障害"];

        for($i = 0; $i < 5; $i++){
          DB::table('matching_post')->insert([
             "num" => null,
             "user_id" => "user1",
             "target_num" => null,
             "title" => $title[$i],
             "content" => "月給100以上、勤務時間1時間以内",
             "roadAddress" => "東京都",
             'gender' => "男",
             'age' => $age[$i],
             'disability'=> $disability[$i],
             'work_day' => "週5回",
             'work_period' => "3ヵ月未満",
             'view' => "0",
          ]);
        }

        $title = ["親切な人を探しています", "母親が体が良くないです", "資格を持っている人を探しています", "介護経歴のずいぶんある方を願います", "家族みたいに優しい人を探しています"];

        $age = ["20代", "50代", "40代", "30代", "70代以上"];

        $disability = ["自閉性障害", "肢体障害", "聴覚障害", "顔面障害", "言語障害"];

        for($i = 0; $i < 5; $i++){
          DB::table('matching_post')->insert([
             "num" => null,
             "user_id" => "user2",
             "target_num" => "1",
             "title" => $title[$i],
             "content" => "月給100以上、勤務時間1時間以内",
             "roadAddress" => "東京都",
             'gender' => "女",
             'age' => $age[$i],
             'disability' => $disability[$i],
             'work_day' => "週5回",
             'work_period' => "3ヵ月未満",
             'view' => "0",
          ]);
        }
    }
}
