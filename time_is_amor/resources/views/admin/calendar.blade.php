<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>TimE is AMOr | Calendar</title>
  </head>
  <body>
    <!-- カレンダー画面 -->
    <table class="table table-bordered">
    <tr>
      <th scope="col">月</th>
      <th scope="col">火</th>
      <th scope="col">水</th>
      <th scope="col">木</th>
      <th scope="col">金</th>
      <th scope="col">土</th>
      <th scope="col">日</th>
    </tr>
    <tr>
      @for($i = 1 - $firstWeekDay; $i <= $daysInMonth; $i++)
        @if($i <= 0 || $i > $daysInMonth)
        <td></td>
        @else
        <td>{{ $i }}</td>
        @endif
      @endfor
    </tr>
  </body>
</html>
