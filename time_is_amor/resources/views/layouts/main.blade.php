<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, inicial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="_base_url" content="{{ url('/') }}">
    <title>@yield('title')</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('css/balloonStyle.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=M+PLUS+Rounded+1c:wght@300;400&display=swap" rel="stylesheet">
    <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>

  </head>
  <body>
    <div class="container-fluid">
      <div class="row calendar">

          @yield('calendar')
          <!-- アニメーション画面 -->
          <div class="ballonPosition balloonAnime" data-animation="{{$animeFlag}}" data-status ="{{is_null($user->balloonStatus)? 0 : $user->balloonStatus}}">
            <img class="balloon" src="/storage/img/balloon01_red.png">
            <img class="balloon" src="/storage/img/balloon02_yellow.png">
            <img class="balloon" src="/storage/img/balloon03_lime.png">
            <img class="balloon" src="/storage/img/balloon08_orange.png">
            <img class="balloon" src="/storage/img/balloon11_white.png">
            <img class="balloon" src="/storage/img/balloon07_purple.png">
            <img class="balloon" src="/storage/img/balloon04_green.png">
            <img class="balloon" src="/storage/img/balloon05_skyblue.png">
            <img class="balloon" src="/storage/img/balloon09_pink.png">
            <img class="balloon" src="/storage/img/balloon10_gray.png">
          </div>
    <!-- プロフィール部分 -->
    <div class="col-6 px-0 profile">
      <div class="col-12 card-group px-0">
        <div class="profile-top">
          <button type="button" class="close btn__close text-right" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h6 class="text-center">アカウント</h6>
        </div>
        <div class="card profile__info mb-0">

          @if($user->bgImg === null)
          <img class="profile__img-top" src="/storage/img/bg-img.jpg" focusable="false" role="img">
          @else
          <img class="profile__img-top" src="/storage/img/{{$user->bgImg}}" focusable="false" role="img">
          @endif
          @if($user->iconImg === null)
          <img class="profile__img" src="/storage/img/profile_acount.jpeg" alt="アイコン画像">
          @else
          <img class="profile__img" src="/storage/img/{{$user->iconImg}}" alt="アイコン画像">
          @endif
          <div class="card-body profilr__info-body">
                <h6 class="card-title">{{$user->name}}</h6>
                <p>{{$user->birthday}}</p>
            <button type="button" class="btn-color btn-sm" data-toggle="modal" data-target="#modal__edit">編集</button>
          </div>
        </div>
        <div class="card profile__info mb-0">
          @if($partner == 0)
          <img class="profile__img-top" src="/storage/img/bg-img.jpg" focusable="false" role="img">
          @elseif($partner->bgImg != null)
          <img class="profile__img-top" src="/storage/img/{{$partner->bgImg}}" focusable="false" role="img">
          @endif
          @if($partner == 0)
          <img class="profile__img" src="/storage/img/profile_acount.jpeg" alt="アイコン画像">
          @elseif($partner->iconImg != null)
          <img class="profile__img" src="/storage/img/{{$partner->iconImg}}" alt="アイコン画像">
          @endif
          <div class="card-body profilr__info-body">
            @if($partner != 0)
            <h6 class="card-title">{{$partner->name}}</h6>
            <p>{{$partner->birthday}}</p>
            @else
            <h6 class="card-title"></h6>
            <p></p>
            @endif
            @if($partner == 0)
            <button type="button" class="btn-color btn-sm" data-toggle="modal" data-target="#modal__invitation">招待</button>
            @endif
          </div>
        </div>
      </div>
    </div>

    <!-- アカウント編集（モーダル） -->
    <div class="modal fade" id="modal__edit" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content edit-content">
          <form class="card edit-form" action="{{ action('CalendarController@profileUpdate') }}" method="post" enctype="multipart/form-data">
            <div class="form-group col-12 icon-info">
              <input id="icon" type="file" name="iconImage">
              <label for="icon">
                @if($user->iconImg === null)
                <img id="iconImage" class="profile__img edit-form__icon" src="/storage/img/profile_acount.jpeg" alt="アイコン画像（編集用）">
                @else
                <img id="iconImage" class="profile__img edit-form__icon" src="/storage/img/{{$user->iconImg}}" alt="アイコン画像（編集用）">
                @endif
              </label>
              <input id="bg" type="file" name="bgImage">
              <label class="edit-form__bg" for="bg">
                @if($user->bgImg === null)
                <img id="bgImage" class="profile__img-top" src="/storage/img/bg-img.jpg" alt="背景画像（編集用）">
                @else
                <img id="bgImage" class="profile__img-top" src="/storage/img/{{$user->bgImg}}" alt="背景画像（編集用）">
                @endif
              </label>
            </div>
            <div class="card-body edit-form__items">
              <div class="form-group">
                <label class="col-md-4 col-form-label text-md-right" for="name">名前</label>
                <input id="name" class="form-control col-11 mx-auto" type="text" name="name" value="{{$user->name}}" required>
                <label class="col-md-4 col-form-label text-md-right" for="email">メールアドレス</label>
                <input id="email" class="form-control col-11 mx-auto" type="email" name="mail" value="{{$user->email}}" required>
              </div>
                <div class="form-group">
                  {{ csrf_field() }}
                  <input type="submit" class="btn-color form-control col-11 mx-auto" value="変更">
                </div>
              </div>
          </form>
        </div>
      </div>
    </div>
    <!-- 招待画面（モーダル） -->
    <div class="modal fade" id="modal__invitation" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5>招待</h5>
          </div>
          <form class="modal-body invitation-form" action="{{ action('InvitationController@mail') }}" method="post">
            <div class="form-grop">
              <textarea class="col-12" name="textForSend" rows="7" placeholder="パートナーを招待するときの文章を書いてください（２００文字以内）"></textarea>
            </div>
            <div class="form-group">
              <input class="form-control" type="email" name="toEmail" placeholder="パートナーのアドレス">
            </div>
            {{ csrf_field() }}
            <button class="btn-color btn-sm col-12" type="submit">送信</button>
          </form>
        </div>
      </div>
    </div>

    <!-- 予定追加画面（モーダル） -->
    <div class="modal fade" id="modal__addPlan" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <form class="plan-form" action="{{ action('CalendarController@addPlan') }}" method="post" enctype="multipart/form-data">
            @if(count($errors) > 0)
              <ul>
                @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
                @endforeach
              </ul>
              @endif
            <div id="add-plan">
              <div class="form-group col-12 px-0 plan-form__title">
                <input class="form-control text-center plan-form__title add-plan" type="text" name="planTitle" placeholder="予定タイトル" required>
              </div>
              <div class="form-group d-flex justify-content-around mb-0 start-date">
                <input class="form-control col-5 add-plan sDate" type="date" name="startDate" placeholder="開始日付" required>
                <input class="form-control col-5 start-date__time add-plan sTime" type="time" name="startTime" placeholder="開始時刻" required>
              </div>
              <p class="text-center p-0 m-0 text-body">⇩</p>
              <div class="form-group d-flex justify-content-around end-date">
                <input class="form-control col-5 add-plan eDate" type="date" name="endDate" placeholder="終了日付" required>
                <input class="form-control col-5 add-plan eTime" type="time" name="endTime" placeholder="終了時刻" required>
              </div>
            </div>
            <div id="done-for-us">
              <div class="form-group">
                <div class="form-group col-12 px-0 plan-form__title">
                  <input class="form-control text-center plan-form__title coment" type="text" name="comentTitle" placeholder="コメントタイトル">
                </div>
                <div class="form-group">
                  <input class="form-control col-12 coment" type="date" name="comentDate" placeholder="日付">
                </div>
              </div>
            </div>
            <div class="form-group">
              <div class="plan-form__change-btn text-center">
                <input class="change-btn" type="checkbox" id="changebtn">
                <label class="change-btn-label" for="changebtn">ADD PLAN</label>
              </div>
            </div>
            <!-- 予定追加・色変更 -->
            <div id="color" class="form-group d-flex justify-content-center">
              <div class="color-items">
                <label for="colorOption" class="colorLabel text-body">色選択</label>
                <input id="colorOption" type="color" name="color" value="#dd5858" list="data1" class="add-plan" required>
                <datalist id="data1">
                  <option value="#dd5858"></option>
                  <option value="#659BDF"></option>
                  <option value="#579779"></option>
                </datalist>
              </div>
            </div>
            <!-- 予定追加・いいね！ -->
            <div id="like" class="form-group">
              <div class="like-items">
                <input class="coment" id="like-01" type="radio" name="like" value="3">
                <label for="like-01">
                  <img src="/storage/img/likeSmall.png" alt="いいね！">
                </label>
                <input class="coment" id="like-02" type="radio" name="like" value="2">
                <label for="like-02">
                  <img src="/storage/img/likeMiddle.png" alt="いいね！">
                </label>
                <input class="coment" id="like-03" type="radio" name="like" value="1">
                <label for="like-03">
                  <img src="/storage/img/likeLarge.png" alt="いいね！">
                </label>
              </div>
            </div>
            {{ csrf_field() }}
            <div class="form-group">
              <input id="submit" class="btn-color form-control col-11 mx-auto" data-action="{{ action('CalendarController@comentList') }}" type="submit" value="保存">
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- コメント一覧 -->
    <div class="modal fade" id="modal__coment-list" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content comment-">
          {!! $comentList !!}
        </div>
      </div>
    </div>
  </div>
</div>
<script src="{{ asset('js/planList_ajax.js') }}" type="module"></script>
<script src="{{ asset('js/calendar.js') }}" type="module"></script>
<script src="{{ asset('js/swipe.js') }}" type="module"></script>
<script src="{{ asset('js/balloonAnimation.js') }}" type="module"></script>
</body>
</html>
