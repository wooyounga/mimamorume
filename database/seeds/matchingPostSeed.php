<?php

use Illuminate\Database\Seeder;

class matchingPostSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $title = ["대상자 구합니다", "일하고 싶습니다", "자격증 있습니다", "경력 30년", "가족처럼 대합니다",
        "장인정신으로 일합니다", "제발 뽑아주세요", "부르면 갑니다 스피드요양원", "여기 뭐하는 곳임?", "미래를 향해 달려갑니다 zesTnT"];

        $age = ["20대", "50대", "40대", "30대", "60대 이상",
        "60대", "20대", "10대 미만", "30대", "40대"];

        $disability = ["자폐성장애", "지체장애", "청각장애", "안면장애", "언어장애",
        "뇌병변장애", "지적장애", "자폐성장애", "안면장애", "청각장애"];

        for($i = 0; $i < 5; $i++){
          DB::table('matching_post')->insert([
             "num" => null,
             "user_id" => "user1",
             "target_num" => null,
             "title" => $title[$i],
             "content" => "월급 100 이상 근무시간 30분 이하",
             "roadAddress" => "대구 북구 복현동",
             "user_type" => "대상자",
             'gender' => "남",
             'age' => $age[$i],
             'disability'=> $disability[$i],
             'work_day' => "주 5회",
             'work_period' => "3개월 미만",
             'view' => "0",
          ]);
        }

        for($i = 5; $i < 10; $i++){
          DB::table('matching_post')->insert([
             "num" => null,
             "user_id" => "user2",
             "target_num" => "1",
             "title" => $title[$i],
             "content" => "월급 100 이상 근무시간 30분 이하",
             "roadAddress" => "대구 북구 복현동",
             "user_type" => "보호사",
             'gender' => "여",
             'age' => $age[$i],
             'disability'=> $disability[$i],
             'work_day' => "주 5회",
             'work_period' => "3개월 미만",
             'view' => "0",
          ]);
        }
    }
}
