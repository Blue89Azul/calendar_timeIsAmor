<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>TimE is AMOr | Calendar</title>
  </head>
  <body>
    <table>
      <tr>
        @foreach($display->weeks as $week)
        <thead>
          {{ $week }}
        </thead>
        @endforeach
      </tr>
    </table>
  </body>
</html>
