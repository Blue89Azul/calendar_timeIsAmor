<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Components\Holidays;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Users;
use App\Models\AddPlan;
use App\Models\ComentList;
use Carbon\Carbon;

class Calendar extends Model
{
    private $htmlCale;
    public function showCale($year, $month, $holidays)
    {
        $dt = new Carbon;
        $authUser = Auth::user();
        if ($year === null) {
            $y = $dt->year;
            $m = $dt->month;
        }
        $today = $dt->today();
        $date = $dt->createFromDate($year, $month);
        $subDate = $dt->createFromDate($year, $month, 1)->subMonth();
        $nextDate = $dt->createFromDate($year, $month, 1)->addMonth();
        $firstWeekDays = $dt->createFromDate($year, $month, 1)->dayOfWeek;
        $NumMonday = 1;
        $days = $NumMonday - $firstWeekDays;
        $daysInMonth = $dt->createFromDate($year, $month, 1)->daysInMonth;
        $subDIM = $dt->subMonth()->daysInMonth;
        $nextMonth = 1;
        $dayCountar = 1;
        $planCounter = 0;
        $posiSubM = 20;
        $posiM = 20;
        $posiNextM = 20;
        $addplans = Users::find(Auth::id())->addplans; //リレーション
        empty($authUser->pertner_id)? $pertnerPlan = null : $pertnerPlan = Users::find($authUser->pertner_id)->addplans; //
        $this->htmlCale = <<<EOS
    <table id="calendarTable" class="calendar__table">
      <thead class="calendar__weekdays">
        <tr>
          <th scope="col">Dom</th>
          <th scope="col">Lun</th>
          <th scope="col">Mar</th>
          <th scope="col">Mir</th>
          <th scope="col">Juv</th>
          <th scope="col">Vir</th>
          <th scope="col">Sáb</th>
        </tr>
      </thead>
    EOS;
        $this->htmlCale .= '<tbody id="swipe" class="calendar__days">';

        while ($dayCountar <= 42) {
            $this->htmlCale .= '<tr class="week">';
            for ($i = 0; $i < 7; $i++) {
                if ($days <= 0) {
                    $d = $subDIM + $days;
                    foreach ($holidays as $h) {
                      $hDate = $dt->createFromDate($h['date']);
                      if($subDate->year == $hDate->year && $subDate->month == $hDate->month && $d == $hDate->day){
                          $this->htmlCale .='<td><p class="other-week text-danger h pre" data-name='.$h['name'].'>'. $d .'</p>';
                          $i++;
                          $d++;
                          $dayCountar++;
                      }
                    }
                    switch ($i) {
                    case 0:
                    $this->htmlCale .='<td><p class="other-week text-danger pre">'. $d .'</p>';
                      break;
                    case 6:
                    $this->htmlCale .='<td><p class="other-week text-primary pre">'. $d .'</p>';
                      break;
                    default:
                    $this->htmlCale .='<td><p class="other-week pre">'. $d .'</p>';
                  }
                  // 予定入力（回し方が重要やなー）ここでできるだけ大きい塊で持ってきて、foreachの中で細かくする方法かなぁ...
                    foreach ($addplans as $pd) {
                        $startDate = $dt->createFromDate($pd->startDate);
                        $dataY = $startDate->year;
                        $dataM = $startDate->month;
                        $dataD = $startDate->day;

                        if($planCounter >= 3){
                          $planCounter = 0;
                          break;
                        }else{
                          if ($subDate->year === $dataY && $subDate->month === $dataM &&  $d === $dataD) {
                              $this->htmlCale .= '<span class="plan-item" style="background-color:' . $pd->color .'; left:'.$posiSubM.'%;"></span>';
                              $posiSubM += 30;
                              $planCounter++;
                          }
                        }
                    }
                    $posiSubM = 20;
                    $this->htmlCale .= '</td>';
                }

                if ($days >= 1 && $days <= $daysInMonth) {
                    //今日の日付
                    foreach ($holidays as $h) {
                      $hDate = $dt->createFromDate($h['date']);
                      if($date->year == $hDate->year && $date->month == $hDate->month && $days == $hDate->day){
                          $this->htmlCale .='<td><p class="text-danger h" data-name='.$h['name'].'>'. $days .'</p>';
                          $i++;
                          $days++;
                          $dayCountar++;
                      }
                    }

                    if ($date->year === $today->year && $date->month === $today->month && $days === $today->day) {
                        $this->htmlCale .='<td><p style="background-color: #A8AD00; color: #fff; text-shadow: none;">'.$days.'</p>';
                    } else {
                        //それ以外は、土日は色変更
                        switch ($i) {
                          case 0:
                            $this->htmlCale .='<td><p class="text-danger">'.$days.'</p>';
                          break;
                          case 6:
                            $this->htmlCale .='<td><p class="text-primary">'.$days.'</p>';
                          break;
                          default:
                            $this->htmlCale .='<td><p>'.$days.'</p>';                    }
                    }
                    // 予定が入力された場合の処理
                    foreach ($addplans as $pd) {
                      $startDate = $dt->createFromDate($pd->startDate);
                      $dataY = $startDate->year;
                      $dataM = $startDate->month;
                      $dataD = $startDate->day;
                      if($planCounter >= 3){
                        $planCounter = 0;
                        break;
                      } else {
                        if ($date->year == $dataY && $date->month == $dataM &&  $days == $dataD) {
                            $this->htmlCale .= '<span class="plan-item" style="background-color:' . $pd->color .';
                            left:'.$posiM.'%;"></span>';
                            $posiM += 30;
                            $planCounter++;
                        }
                      }
                    }
                    $posiM = 20;
                    $this->htmlCale .= '</td>';
                }

                if ($days > $daysInMonth && $dayCountar <= 42) {
                  foreach ($holidays as $h) {
                    $hDate = $dt->createFromDate($h['date']);
                    if($nextDate->year == $hDate->year && $nextDate->month == $hDate->month && $nextMonth == $hDate->day){
                        $this->htmlCale .='<td><p class="other-week text-danger h next" data-name='.$h['name'].'>'. $nextMonth .'</p>';
                        $i++;
                        $nextMonth++;
                        $dayCountar++;
                    }
                  }
                    switch ($i) {
                    case 0:
                        $this->htmlCale .= '<td><p class="other-week text-danger next">'.$nextMonth .'</p>';
                      break;

                    case 6:
                        $this->htmlCale .= '<td><p class="other-week text-primary next">'.$nextMonth .'</p>';              break;
                    default:
                        $this->htmlCale .= '<td><p class="other-week next">'.$nextMonth .'</p>';
                  }
                    foreach ($addplans as $pd) {
                      $startDate = $dt->createFromDate($pd->startDate);
                      $dataY = $startDate->year;
                      $dataM = $startDate->month;
                      $dataD = $startDate->day;
                      if($planCounter >= 3){
                        $planCounter = 0;
                        break;
                      }else{
                        if ($nextDate->year == $dataY && $nextDate->month == $dataM &&  $nextMonth == $dataD) {
                            $this->htmlCale .= '<span class="plan-item" style="background-color:' . $pd->color .';
                            left:'.$posiNextM.'%;"></span>';
                            $posiNextM += 30;
                        }
                      }
                    }
                    $posiNextM = 20;
                    $nextMonth++;
                    $this->htmlCale .= '</td>';
                }
                $days++;
                $dayCountar++;
            }
            $this->htmlCale .= '</tr>';
        }
        return $this->htmlCale .= '</tbody></table>';
    }

    private $changeMonth;
    public function changeMonth($year, $month)
    {
        $dt = new Carbon;
        if ($year === null) {
            $year = $dt->year;
            $month = $dt->month;
        }

        $sDate = $dt->createFromDate($year, $month);
        $subMonth = $sDate->subMonth();
        $subY =$subMonth->year;
        $subM = $subMonth->month;
        $aDate = $dt->createFromDate($year, $month);
        $addMonth = $aDate->addMonth();
        $addY = $addMonth->year;
        $addM = $addMonth->month;
        $this->changeMonth =<<<EOS
      <div class="col-6 calendar-title">
          <a href="?year={$subY}&month={$subM}" class="arrow-pre"></a>
            <h1 class="this-month">
              <span>{$year}</span>
              <span class="monthAjax">{$month}</span>
            </h1>
          <a href="?year={$addY}&month={$addM}" class="arrow-next"></a>
      </div>
      EOS;
        return $this->changeMonth;
    }

    private $comentList;
    public function comentList($year, $month)
    {
        $dt = new Carbon;
        $authId = Auth::id();
        if ($year === null) {
            $year = $dt->year;
            $month = $dt->month;
        }
        $comments = ComentList::where("users_id", $authId)->get();
        $commentlists = Users::find($authId)->comentlists;

        $this->comentList .=<<<EOS
                    <div class="modal-header coment-list__header">
                    <h5>DONE FOR US<span>{$year}. {$month}</span></h5>
                    </div>
                    <div class="modal-body commentBody">
                    EOS;
        foreach ($comments as $comment) {
            $cYear = $dt->createFromDate($comment->comentDate)->year;
            $cMonth = $dt->createFromDate($comment->comentDate)->month;
            $cDay = $dt->createFromDate($comment->comentDate)->day;
            if ($year == $cYear && $month == $cMonth) {
                $this->comentList .=<<<EOS
                  <div class="card col-11 mx-auto">
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                      <div class="coment-date d-inline-block">
                        <p class="d-inline">{$cMonth}月{$cDay}日</p>
                        <span>{$comment->users->name}</span> → <span>くまモン</span>
                      </div>
                      <div class="likes d-inline-block">
                  EOS;
                if (isset($comment->like)) {
                    for ($i=1; $i <= $comment->like ; $i++) {
                        $this->comentList .= '<img src="/storage/img/like.png" alt="いいね">';
                    }
                }
                $this->comentList .= '</div><p class="main-coment text-center">'.$comment->comentTitle.'</p></li>';
            }
            $this->comentList .= '</ul></div>';
        }
        return $this->comentList .= '</div>';
    }

    private $planList;
    public function planList($year, $month, $clickNum)
    {
        $dt = new Carbon;
        $authId = Auth::id();
        $date = $dt->createFromDate($year, $month);
        $planDatas = Users::find($authId)->addplans;
        $csrf = csrf_field();
        $this->planList .="<ul>";
        foreach ($planDatas as $pd) {
            $startDate = $dt->createFromDate($pd->startDate);
            $dataY = $startDate->year;
            $dataM = $startDate->month;
            $dataD = $startDate->day;
            $url = action("CalendarController@planDelete");
                if ($date->year === $dataY && $date->month === $dataM && $clickNum == $dataD) {
                    $this->planList .=<<<EOS
                    <li class='plan-list-items'>
                    <span style='background-color:{$pd->color};'></span>
                    <div class='plan-list-items__time'>
                    <p>{$pd->startTime}</p>
                    <p>{$pd->endTime}</p>
                    </div>
                    <p class='plan-list-items__title'>{$pd->planTitle}</p>
                    <form method="post" class="deleteForm" action="{$url}">
                    {$csrf}
                    <input type="hidden" name="id" value="{$pd->id}">
                    <input class="deletePlan" type="submit" value="削除">
                    </form>
                    </li>
                    EOS;
                }
        }
        return $this->planList .= "</ul>";
    }

}
