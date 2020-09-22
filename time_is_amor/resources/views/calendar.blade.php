@extends('layouts.main')
@section('title', 'TimE is AMOr | Calendar')

@section('calendar')

    <div class="calendar-date">
      <form class="header-option col-3 album" action="#" method="post" enctype="multipart/form-data">
        <input id="album" type="file" name="" value="">
        <label class="header-option__btn" for="album">
          <img src="/storage/img/camara.png" alt="今月の一枚">
        </label>
        <div class="month-img">
          <a href="/storage/img/bg-img.jpg" class="modal-img">
            <img src="/storage/img/bg-img.jpg" alt="登録画像">
          </a>
        </div>
        <div class="gray-layer"></div>
        <div class="over-layer">
          <img src="#" alt="画像：モーダル表示">
        </div>
      </form>

{!! $changeMonth !!}

      <div class="col-3 header-option">
        <button class="header-option__btn" type="button" name="button">HOY</button>
      </div>
    </div>

{!! $cal !!}

  <div class="calendar-footer">
    <p><?php echo $today->month ?>月<?php echo $today->day ?>日</p>
    <div class="option-btns">
      <button class="option-btn__acount" type="button" name="button">
        <img src="/storage/img/profile.jpeg" alt="プロフィール">
      </button>
        <button class="option-btn__add-plan" type="button" name="button" data-toggle="modal" data-target="#modal__addPlan">
          <img src="/storage/img/calendar-icon.png" alt="予定追加">
        </button>
        <button class="option-btn__coment-list" type="button" name="button" data-toggle="modal" data-target="#modal__coment-list">
          <img src="/storage/img/coment-list-icon.png" alt="コメントリスト">
        </button>
        </div>
      </div>
      <div class="plan-list"></div>
@endsection
