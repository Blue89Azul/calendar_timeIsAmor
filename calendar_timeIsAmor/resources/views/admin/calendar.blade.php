

<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>TimE is AMOr | Calendar</title>
  </head>
  <body>
    <table>
      <tr>
        <!--  -->
        <thead>
          @foreach(weeks as $week)
          <th>{{ $week }}</th>
          @endforeach
        </thead>
      </tr>

    </table>
  </body>
</html>
