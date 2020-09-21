<!DOCTYPE html>
<html lang="ja" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>TimE is AMOr | HOME</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="{{asset('css/homeStyle.css')}}">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <script src="{{ asset('js/app.js') }}" defer></script>
  <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c:wght@300;400&display=swap" rel="stylesheet">
</head>
<body id="home">
  <nav class="global-menu">
    <ul class="global-menu__main">
      <li class="global-menu__item">
        <a class="mobile-link" href="{{route('register')}}">
          <span class="main-title">SIGN UP</span>
          <span class="sub-title">新規登録</span>
        </a>
      </li>
      <li class="global-menu__item">
        <a class="mobile-link" href="{{ route('login') }}">
          <span class="main-title">SIGN IN</span>
          <span class="sub-title">登録済み</span>
        </a>
      </li>
    </ul>
  </nav>
  <div class="contents">
    <div class="contents-cover">
      <button class="menuBtn" type="button" name="button">
        <span></span>
        <span></span>
        <span></span>
        <p>menu</p>
      </button>
      <div class="homeTitles">
        <h1><span>T</span>im<span>E</span> is <span>AMO</span>r</h1>
      </div>
    </div>
  </div>
<script src="{{asset('js/home.js')}} " type=module></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
