<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>TimE is AMOr | Calendar</title>
  </head>
  <body>
{{ $carrentDay }}
<table class="table" border="1">
  <thead>
@foreach($dayOfWeek as $day)
    <th>{{ $day }}</th>
@endforeach
  </thead>
  <tbody>
    <tr>
@for($i = 1; $i <= $daysInMonth; $i++)
  @if($i === 1)
    @if()
      <td>{{ $i }}</td>
  @endif
    @endif
@endfor
    </tr>
  </tbody>
</table>
  </body>
</html>
