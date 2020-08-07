<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>TimE is AMOr | Calendar</title>
  </head>
  <body>
    <!-- カレンダー画面 -->
    <h1>{{ $year }}年 {{ $month }}月</h1>
    <table class="table" border="1">
      <thead>
        <th class="header">月</th>
        <th class="header">火</th>
        <th class="header">水</th>
        <th class="header">木</th>
        <th class="header">金</th>
        <th class="header">土</th>
        <th class="header">日</th>
      </thead>
      <tbody>
        <!-- なんだかややこしくなった。。。 -->
          @while($day <= $daysInMonth)
              <tr>
            @for($i = 0; $i < 7; $i++)
              @if($day <= 0 || $day > $daysInMonth)
                <td></td>
              @else
                <td>{{ $day }}</td>
              @endif
              <?php $day++; ?>
            @endfor
              </tr>
          @endwhile
      </tbody>
  </body>
</html>
