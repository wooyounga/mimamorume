@extends('layouts.app')

<link rel="stylesheet" href="css/AdminLTE.css">
<script src="js/dashboard.js"></script>
{{-- <script src="plugins/flot/jquery.flot.js"></script> --}}

@section('content')
<div id="bgimg">
  <div class="page_title">
    管理者ページ
  </div>
  <br>
  <a href="{{URL::to('/home')}}"><img src="{{URL::to('/')}}/images/home.png" style="position:relative; top:-3px; width:20px; height:20px;"></a> > <a href="{{URL::to('/dashboard')}}">管理者ページ</a>
</div>
<style>
  #bgimg{
    background-image: url("{{ URL::to('/') }}/images/bgimg/pt.png");
    background-size: cover;
    height: 300px;
    padding-left: 75px;
    padding-top: 70px;
    color: white;
    font-size: 17px;
    font-weight: bold;
  }
  #bgimg > a{
    color: white;
    text-decoration: none;
    font-size: 17px;
    font-weight: bold;
  }
  .page_title{
    color: white;
    font-size: 40px;
    margin-bottom: 100px;
  }
</style>
<div class="container" style="margin-top: 50px;">
  <div class="row">
    {{-- <div class="notice">
      <div class="col-md-12">
          <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">お知らせ</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table>
                <tr>
                  <th>番号</th>
                  <th>タイトル</th>
                  <th>作成者</th>
                  <th>日付</th>
                  <th>クリック数</th>
                </tr>
                <tr>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
    </div> --}}

    <div class="subscript">
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-blue">
          <div class="inner">
            <h3>{{ count($family) }}</h3>

            <p>保護者</p>
          </div>
          <div class="icon">
            <img src="images/family.png" alt="family" style="width: 70px;">
          </div>
          {{-- <a href="#" class="family-info small-box-footer">
            詳細情報</i>
          </a> --}}
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
          <div class="inner">
            <h3>{{ count($supporter) }}</h3>

            <p>介護職員</p>
          </div>
          <div class="icon">
            <img src="images/supporter.png" alt="supporter" style="width: 80px;">
          </div>
          {{-- <a href="#" class="supporter-info small-box-footer">
            詳細情報</i>
          </a> --}}
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3>{{ count($target) }}</h3>

            <p>保護対象</p>
          </div>
          <div class="icon">
            <img src="images/target.png" alt="target" style="width: 80px;">
          </div>
          {{-- <a href="#" class="target-info small-box-footer">
            詳細情報</i>
          </a> --}}
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
          <div class="inner">
            <h3>{{ count($contract) }}</h3>

            <p>契約情報</p>
          </div>
          <div class="icon">
            <img src="images/hands.png" alt="hands" style="width: 80px;">
          </div>
          {{-- <a href="#" class="contract-info small-box-footer">
            詳細情報</i>
          </a> --}}
        </div>
      </div>
      <!-- ./col -->
    </div>

    <div class="family-information">
      <div class="col-md-12">
          <div class="box box-blue open-box">
            <div class="box-header with-border">
              <h3 class="box-title">保護者詳細情報</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="col-lg-12" style="text-align: center">
                <tr>
                  <th style="text-align: center">アカウント</th>
                  <th style="text-align: center">名前</th>
                  <th style="text-align: center">年齢</th>
                  <th style="text-align: center">性別</th>
                  <th style="text-align: center">イーメール</th>
                  <th style="text-align: center">電話番号</th>
                  <th style="text-align: center">携帯番号</th>
                  <th style="text-align: center">アドレス</th>
                  <th style="text-align: center">保護対象</th>
                </tr>
                @foreach($family as $f)
                <tr>
                  <td>{{ $f->id }}</td>
                  <td>{{ $f->name }}</td>
                  <td>{{ $f->age }}</td>
                  <td>{{ $f->gender }}</td>
                  <td>{{ $f->email }}</td>
                  <td>{{ $f->telephone }}</td>
                  <td>{{ $f->cellphone }}</td>
                  <td>{{ $f->main_address }} {{ $f->rest_address }}</td>
                  <td>1. キム・ソンヨン</td>
                </tr>
                @endforeach
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
    </div>

    <div class="supporter-information">
      <div class="col-md-12">
          <div class="box box-green open-box">
            <div class="box-header with-border">
              <h3 class="box-title">介護職員詳細情報</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="col-lg-12" style="text-align: center">
                <tr>
                  <th style="text-align: center">アカウント</th>
                  <th style="text-align: center">名前</th>
                  <th style="text-align: center">年齢</th>
                  <th style="text-align: center">性別</th>
                  <th style="text-align: center">イーメール</th>
                  <th style="text-align: center">電話番号</th>
                  <th style="text-align: center">携帯番号</th>
                  <th style="text-align: center">アドレス</th>
                  <th style="text-align: center">資格</th>
                </tr>
                @foreach($supporter as $s)
                <tr>
                  <td>{{ $s->id }}</td>
                  <td>{{ $s->name }}</td>
                  <td>{{ $s->age }}</td>
                  <td>{{ $s->gender }}</td>
                  <td>{{ $s->email }}</td>
                  <td>{{ $s->telephone }}</td>
                  <td>{{ $s->cellphone }}</td>
                  <td>{{ $s->main_address }} {{ $s->rest_address }}</td>
                  <td>障害者活動補助人衛戍症</td>
                </tr>
                @endforeach
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
    </div>

    <div class="target-information">
      <div class="col-md-12">
          <div class="box box-yellow open-box">
            <div class="box-header with-border">
              <h3 class="box-title">対象者詳細情報</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="col-lg-12" style="text-align: center">
                <tr>
                  <th style="text-align: center">対象番号</th>
                  <th style="text-align: center">名前</th>
                  <th style="text-align: center">年齢</th>
                  <th style="text-align: center">性別</th>
                  <th style="text-align: center">電話番号</th>
                  <th style="text-align: center">携帯番号</th>
                  <th style="text-align: center">アドレス</th>
                  <th style="text-align: center">障害種類</th>
                  <th style="text-align: center">特異事項</th>
                </tr>
                @foreach($target as $t)
                <tr>
                  <td>{{ $t->num }}</td>
                  <td>{{ $t->name }}</td>
                  <td>{{ $t->age }}</td>
                  <td>{{ $t->gender }}</td>
                  <td>{{ $t->telephone }}</td>
                  <td>{{ $t->cellphone }}</td>
                  <td>{{ $t->main_address }} {{ $t->rest_address }}</td>
                  <td>{{ $t->disability_main }} {{ $t->disability_sub }}</td>
                  <td>{{ $t->comment }}</td>
                </tr>
                @endforeach
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
    </div>

    <div class="contract-information">
      <div class="col-md-12">
          <div class="box box-red open-box">
            <div class="box-header with-border">
              <h3 class="box-title">契約詳細情報</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="col-lg-12" style="text-align: center">
                <tr>
                  <th style="text-align: center">保護者アカウント</th>
                  <th style="text-align: center">介護職員アカウント</th>
                  <th style="text-align: center">契約期間</th>
                  <th style="text-align: center">契約開始日</th>
                  <th style="text-align: center">契約終了日</th>
                </tr>
                <tr>
                  <td>{{ $contract[0]->family_id }}</td>
                  <td>{{ $contract[0]->sitter_id }}</td>
                  <td>{{ $contract[0]->work_week }}</td>
                  <td>{{ $contract[0]->work_start }} {{ $contract[0]->work_start_time }}</td>
                  <td>{{ $contract[0]->work_end }} {{ $contract[0]->work_end_time }}</td>
                </tr>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
    </div>

    {{-- <div class="graph">
      <div class="col-xs-6">
        <!-- interactive chart -->
        <div class="box box-solid box-primary">
          <div class="box-header with-border">
            <i class="fa fa-bar-chart-o"></i>

            <h3 class="box-title">保護者接続現況</h3>
          </div>
          <div class="box-body">
            <div id="interactive" style="height: 300px; padding: 0px; position: relative;">
              <canvas class="flot-base" width="1068" height="300" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 1068px; height: 300px;"></canvas>
                <div class="flot-text" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; font-size: smaller; color: rgb(84, 84, 84);">
                  <div class="flot-x-axis flot-x1-axis xAxis x1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px;">
                    <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 97px; top: 283px; left: 21px; text-align: center;">10</div>
                    <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 97px; top: 283px; left: 123px; text-align: center;">8</div>
                    <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 97px; top: 283px; left: 227px; text-align: center;">6</div>
                    <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 97px; top: 283px; left: 332px; text-align: center;">4</div>
                    <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 97px; top: 283px; left: 436px; text-align: center;">2</div>
                  </div>
                  <div class="flot-y-axis flot-y1-axis yAxis y1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px;">
                  <div class="flot-tick-label tickLabel" style="position: absolute; top: 270px; left: 13px; text-align: right;">0</div>
                  <div class="flot-tick-label tickLabel" style="position: absolute; top: 216px; left: 7px; text-align: right;">20</div>
                  <div class="flot-tick-label tickLabel" style="position: absolute; top: 162px; left: 7px; text-align: right;">40</div>
                  <div class="flot-tick-label tickLabel" style="position: absolute; top: 108px; left: 7px; text-align: right;">60</div>
                  <div class="flot-tick-label tickLabel" style="position: absolute; top: 54px; left: 7px; text-align: right;">80</div>
                  <div class="flot-tick-label tickLabel" style="position: absolute; top: 0px; left: 1px; text-align: right;">100</div>
                </div>
              </div>
            <canvas class="flot-overlay" width="1068" height="300" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 1068px; height: 300px;"></canvas>
            </div>
          </div>
          <!-- /.box-body-->
        </div>
        <!-- /.box -->

      </div>

        <div class="col-xs-6">
          <!-- interactive chart -->
          <div class="box box-solid box-success">
            <div class="box-header with-border">
              <i class="fa fa-bar-chart-o"></i>

              <h3 class="box-title">介護職員接続現況</h3>
            </div>
            <div class="box-body">
              <div id="interactive" style="height: 300px; padding: 0px; position: relative;">
                <canvas class="flot-base" width="1068" height="300" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 1068px; height: 300px;"></canvas>
                  <div class="flot-text" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; font-size: smaller; color: rgb(84, 84, 84);">
                    <div class="flot-x-axis flot-x1-axis xAxis x1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px;">
                      <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 97px; top: 283px; left: 21px; text-align: center;">10</div>
                      <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 97px; top: 283px; left: 123px; text-align: center;">8</div>
                      <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 97px; top: 283px; left: 227px; text-align: center;">6</div>
                      <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 97px; top: 283px; left: 332px; text-align: center;">4</div>
                      <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 97px; top: 283px; left: 436px; text-align: center;">2</div>
                    </div>
                    <div class="flot-y-axis flot-y1-axis yAxis y1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px;">
                    <div class="flot-tick-label tickLabel" style="position: absolute; top: 270px; left: 13px; text-align: right;">0</div>
                    <div class="flot-tick-label tickLabel" style="position: absolute; top: 216px; left: 7px; text-align: right;">20</div>
                    <div class="flot-tick-label tickLabel" style="position: absolute; top: 162px; left: 7px; text-align: right;">40</div>
                    <div class="flot-tick-label tickLabel" style="position: absolute; top: 108px; left: 7px; text-align: right;">60</div>
                    <div class="flot-tick-label tickLabel" style="position: absolute; top: 54px; left: 7px; text-align: right;">80</div>
                    <div class="flot-tick-label tickLabel" style="position: absolute; top: 0px; left: 1px; text-align: right;">100</div>
                  </div>
                </div>
              <canvas class="flot-overlay" width="1068" height="300" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 1068px; height: 300px;"></canvas>
              </div>
            </div>
            <!-- /.box-body-->
          </div>
          <!-- /.box -->

        </div>
    </div> --}}

  </div>
</div>
<br><br>
@endsection
