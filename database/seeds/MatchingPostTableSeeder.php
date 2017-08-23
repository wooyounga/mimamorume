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
        $title = ["대상자 구합니다", "일하고 싶습니다", "자격증 있습니다", "경력 30년", "가족처럼 대합니다"];

        $age = ["20대", "50대", "40대", "30대", "60대 이상"];

        $disability = ["자폐성장애", "지체장애", "청각장애", "안면장애", "언어장애"];

        for($i = 0; $i < 5; $i++){
          DB::table('matching_post')->insert([
             "num" => null,
             "user_id" => "user1",
             "target_num" => null,
             "title" => $title[$i],
             "content" => "월급 100 이상 근무시간 30분 이하",
             "roadAddress" => "대구 북구 복현동",
             'gender' => "남성",
             'age' => $age[$i],
             'disability'=> $disability[$i],
             'work_day' => "주 5회",
             'work_period' => "3개월 미만",
             'view' => "0",
          ]);
        }

        $title = ["보호사 구합니다", "우리 가족이 활동하고 싶어 합니다", "장애인 관련 자격증 있으신 분", "경력 3년 이상", "가족 같은 분 구합니다"];

        $age = ["20대", "50대", "40대", "30대", "60대 이상"];

        $disability = ["자폐성장애", "지체장애", "청각장애", "안면장애", "언어장애"];

        for($i = 0; $i < 5; $i++){
          DB::table('matching_post')->insert([
             "num" => null,
             "user_id" => "user2",
             "target_num" => "1",
             "title" => $title[$i],
             "content" => "월급 100 이상 근무시간 30분 이하",
             "roadAddress" => "대구 북구 복현동",
             'gender' => "여성",
             'age' => $age[$i],
             'disability' => $disability[$i],
             'work_day' => "주 5회",
             'work_period' => "3개월 미만",
             'view' => "0",
          ]);
        }
    }
}
