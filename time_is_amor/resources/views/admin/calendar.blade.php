<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>TimE is AMOr | Calendar</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
    <!-- カレンダー画面 -->
    <h1 id="calTitle">
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
        <th class="header">日</th>
        <th class="header">月</th>
        <th class="header">火</th>
        <th class="header">水</th>
        <th class="header">木</th>
        <th class="header">金</th>
        <th class="header">土</th>
      </thead>
      <tbody>
        <!-- なんだかややこしくなった。。。 -->
          @while($days <= $daysInMonth)
              <tr>
            @for($i = 0; $i < 7; $i++)
              @if($days <= 0 || $days > $daysInMonth)
                <td></td>
              @else
                <td>{{ $days }}</td>
              @endif
              <?php $days++; ?>
            @endfor
              </tr>
          @endwhile
      </tbody>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
