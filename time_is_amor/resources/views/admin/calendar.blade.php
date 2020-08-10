<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>TimE is AMOr | Calendar</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
    <!-- カレンダー画面 -->
    <h1>
      <a class="btn btn-primary"
      href="/admin/calendar/?year={{ $subY }}&month={{ $subM }}" role="button">
        前月</a>
        {{ $year }}年 {{ $month }}月
      <a class="btn btn-primary"
      href="/admin/calendar/?year={{ $addY }}&month={{ $addM }}" role="button">
        翌月</a>
    </h1>

    <table class="table" border="1">
      <thead>
        <th scope="col">日</th>
        <th scope="col">月</th>
        <th scope="col">火</th>
        <th scope="col">水</th>
        <th scope="col">木</th>
        <th scope="col">金</th>
        <th scope="col">土</th>
      </thead>
      <tbody>
        <!-- なんだかややこしくなった。。。 -->
          @while($days <= $daysInMonth)
              <tr>
            @for($i = 0; $i < 7; $i++)
              @if($days <= 0 || $days > $daysInMonth)
                <td><a href="#"></a></td>
              @else
                <td><a href="#">{{ $days }}</a></td>
              @endif
              <?php $days++; ?>
            @endfor
              </tr>
          @endwhile
      </tbody>
    </table>

    <!-- 予定変更画面 -->
    <h2>予定変更画面</h2>
    <div class="container">
      <!-- 開始予定時刻 -->
      <form action= "{{ action('Admin\CalendarController@showInputPlan') }}" method="post" enctype="multipart/form-data">
        @if(count($errors) > 0)
          <ul>
            @foreach($errors->all() as $e)
            <li>{{ $e }}</li>
            @endforeach
          </ul>
          @endif
        <h3>予定タイトル</h3>
        <input type="text" name="planTitle" value="">
            <h3>開始時刻</h3>
            <select class="col-md-1" name="startY" size=3>
              @for($yi = $beforeY; $yi <= $afterY; $yi++)
                @if($yi === $year)
                  <option value="{{$yi}}" selected>{{ $yi }}</option>
                  <br>
                @else
                <option value="{{$yi}}">{{ $yi }}</option>
                <br>
                @endif
              @endfor
            </select>
            <span>年</span>

            <select class="col-md-1" name="startM" size=3>
              @for($mi = 1; $mi <= 12; $mi++)
                @if($mi === $month)
                  <option value="{{$mi}}" selected>{{ $mi }}</option>
                  <br>
                @else
                <option value="{{$mi}}">{{ $mi }}</option>
                <br>
                @endif
              @endfor
            </select>
            <span>月</span>

            <select class="col-md-1" name="startD" size=3>
              @for($di = 1; $di <= 31; $di++)
                @if($di === $day)
                  <option value="{{$di}}" selected>{{ $di }}</option>
                  <br>
                @else
                <option value="{{$di}}">{{ $di }}</option>
                <br>
                @endif
              @endfor
            </select>
            <span>日</span>

            <select class="col-md-1" name="startH" size=3>
              @for($hi = 1; $hi <= 24; $hi++)
                @if($hi === $hour)
                  <option value="{{$hi}}" selected>{{ $hi }}</option>
                  <br>
                @else
                <option value="{{$hi}}">{{ $hi }}</option>
                <br>
                @endif
              @endfor
            </select>
            <span>時</span>

            <select class="col-md-1" name="startMinu" size=3>
              @for($minui = 1; $minui <= 60; $minui++)
                @if($minui === $minute)
                  <option value="{{ $minui }}" selected>{{ $minui }}</option>
                  <br>
                @else
                <option value="{{ $minui }}">{{ $minui }}</option>
                <br>
                @endif
              @endfor
            </select>
            <span>分</span>

            <!-- 終了予定時刻 -->
            <h3>終了時刻　＊初期表示は、開始時刻より＋１時間</h3>
            <select class="col-md-1" name="endY" size=3>
              @for($yi = $beforeY; $yi <= $afterY; $yi++)
                @if($yi === $year)
                  <option value="{{$yi}}" selected>{{ $yi }}</option>
                @else
                <option value="{{$yi}}">{{ $yi }}</option>
                @endif
              @endfor
            </select>
            <span>年</span>

            <select class="col-md-1" name="endM" size=3>
              @for($mi = 1; $mi <= 12; $mi++)
                @if($mi === $month)
                  <option value="{{$mi}}" selected>{{ $mi }}</option>
                  <br>
                @else
                <option value="{{$mi}}">{{ $mi }}</option>
                <br>
                @endif
              @endfor
            </select>
            <span>月</span>

            <select class="col-md-1" name="endD" size=3>
              @for($di = 1; $di <= 31; $di++)
                @if($di === $day)
                  <option value="{{$di}}" selected>{{ $di }}</option>
                  <br>
                @else
                <option value="{{$di}}">{{ $di }}</option>
                <br>
                @endif
              @endfor
            </select>
            <span>日</span>

            <select class="col-md-1" name="endH" size=3>
              @for($hi = 1; $hi <= 24; $hi++)
                @if($hi === $hour)
                  <option value="{{$hi}}" selected>{{ $hi }}</option>
                  <br>
                @else
                <option value="{{$hi}}">{{ $hi }}</option>
                <br>
                @endif
              @endfor
            </select>
            <span>時</span>

            <select class="col-md-1" name="endMinu" size=3>
              @for($minui = 1; $minui <= 60; $minui++)
                @if($minui === $minute)
                  <option value="{{$minui}}" selected>{{ $minui }}</option>
                  <br>
                @else
                <option value="{{$minui}}">{{ $minui }}</option>
                <br>
                @endif
              @endfor
            </select>
            <span>分</span>

        {{ csrf_field() }}
        <input type="submit" class="btn btn-success" role="button" value="予定変更！！">
      </form>
    </div>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
