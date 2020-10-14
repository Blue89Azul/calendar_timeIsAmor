@extends('layouts.main')
@section('title', 'TimE is AMOr | Calendar')
@section('calendar')
    <div class="calendar-date d-flex justify-content-center">
      {!! $changeMonth !!}
    </div>

      {!! $cal !!}
  <div class="calendar-footer">
    <p><span class="clickMonth"></span><span class="clickDay"></span></p>
    <!-- ここの箇所に祝日日付 -->
    <span class="holiday"></span>
    <div class="option-btns">
      <button class="option-btn__acount" type="button" name="button">
        <img src="./images/profile.jpeg" alt="プロフィール">
      </button>
        <button class="option-btn__add-plan" type="button" name="button" data-toggle="modal" data-target="#modal__addPlan">
          <img src="./images/calendar-icon.png" alt="予定追加">
        </button>
        <button class="option-btn__coment-list" type="button" name="button" data-toggle="modal" data-target="#modal__coment-list">
          <img src="./images/coment-list-icon.png" alt="コメントリスト">
        </button>
        </div>
      </div>
      <div class="plan-list"></div>
@endsection
