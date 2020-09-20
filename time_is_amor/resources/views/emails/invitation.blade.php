<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
  </head>
  <body>
    <p>{{$name}}さんから、共有カレンダーアプリ「TimE is AMOr」の招待が届きました！</p>
    <p>****以下、まりもさんからのメッセージです！***</p>
    <p>{{$text}}</p>

    <p>さぁ！今すぐはじめましょう！！</p>
    <a href="action{{ action(InvitationController@getRegister) }}">[ユーザ登録はこちらから！！]</a>
  </body>
</html>

<!-- スタイルを整えたほうがいいかもねー！！ -->
