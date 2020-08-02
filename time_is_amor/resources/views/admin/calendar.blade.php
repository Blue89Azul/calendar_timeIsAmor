<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>TimE is AMOr | Calendar</title>
  </head>
  <body>
{{ $CarrentDay }}

<table>
  <thead>
    @foreach($dayOfWeek as $day)
    <th>{{ $day }}</th>
    @endforeach
  </thead>
</table>

  </body>
</html>
