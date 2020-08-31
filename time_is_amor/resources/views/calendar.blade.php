@extends('layouts.main')
@section('title', 'TimE is AMOr | Calendar')

@section('calendar')

    <div class="calendar-date">
      <form class="header-option col-3 album" action="#" method="post" enctype="multipart/form-data">
        <input id="album" type="file" name="" value="">
        <label class="header-option__btn" for="album">
          <img src="img/camara.png" alt="今月の一枚">
        </label>
        <div class="month-img">
        </div>
      </form>

{!! $changeMonth !!}

      <div class="col-3 header-option">
        <button class="header-option__btn" type="button" name="button">HOY</button>
      </div>
    </div>
    
{!! $cal !!}

  <div class="calendar-footer">
    <p>19 de Agosto</p>
    <div class="option-btns">
      <button class="option-btn__acount" type="button" name="button">
        <img src="img/profile.jpeg" alt="">
      </button>
        <button class="option-btn__add-plan" type="button" name="button" data-toggle="modal" data-target="#modal__addPlan">
          <img src="img/calendar-icon.png" alt="">
        </button>
        <button class="option-btn__coment-list" type="button" name="button" data-toggle="modal" data-target="#modal__coment-list">
          <img src="img/coment-list-icon.png" alt="">
        </button>
        </div>
      </div>

@endsection
