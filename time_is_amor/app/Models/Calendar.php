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
        $planCounterSub = 1;
        $planCounter = 1;
        $planCounterNext = 1;
        $posiSubM = 20;
        $posiM = 20;
        $posiNextM = 20;
        $comparsionA = 0;
        $comparsionB = 0;
        $comparsionC = 0;
        $addplans = AddPlan::whereIn("users_id", [Auth::id(), Auth::user()->partner_id])->orderBy('startDate', 'asc')->get();
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
                        if ($subDate->year == $hDate->year && $subDate->month == $hDate->month && $d == $hDate->day) {
                            $this->htmlCale .='<td data-name='.$h['name'].'><p class="other-week text-danger h" data-month='.$subDate->month.'>'. $d .'</p>';
                            $i++;
                            $d++;
                            $dayCountar++;
                        }
                    }
                    switch ($i) {
                    case 0:
                    $this->htmlCale .='<td><p class="other-week text-danger" data-month='.$subDate->month.'>'. $d .'</p>';
                      break;
                    case 6:
                    $this->htmlCale .='<td><p class="other-week text-primary" data-month='.$subDate->month.'>'. $d .'</p>';
                      break;
                    default:
                    $this->htmlCale .='<td><p class="other-week" data-month='.$subDate->month.'>'. $d .'</p>';
                  }
                    foreach ($addplans as $pd) {
                        $startDate = $dt->createFromDate($pd->startDate);
                        $dataY = $startDate->year;
                        $dataM = $startDate->month;
                        $dataD = $startDate->day;

                        if ($subDate->year === $dataY && $subDate->month === $dataM &&  $d === $dataD) {
                            $this->htmlCale .= '<span class="plan-item" style="background-color:' . $pd->color .'; left:'.$posiSubM.'%;"></span>';
                            $posiSubM += 30;
                        }
                    }
                    $posiSubM = 20;
                    $this->htmlCale .= '</td>';
                }

                if ($days >= 1 && $days <= $daysInMonth) {
                    //今日の日付
                    foreach ($holidays as $h) {
                        $hDate = $dt->createFromDate($h['date']);
                        if ($date->year == $hDate->year && $date->month == $hDate->month && $days == $hDate->day) {
                            $this->htmlCale .='<td data-name='.$h['name'].'><p class="text-danger h" data-month='.$date->month.'>'. $days .'</p>';
                            $i++;
                            $days++;
                            $dayCountar++;
                        }
                    }

                    if ($date->year === $today->year && $date->month === $today->month && $days === $today->day) {
                        $this->htmlCale .='<td><p style="background-color: #A8AD00; color: #fff; text-shadow: none;" data-month='.$date->month.'>'.$days.'</p>';
                    } else {
                        //それ以外は、土日は色変更
                        switch ($i) {
                          case 0:
                            $this->htmlCale .='<td><p class="text-danger" data-month='.$date->month.'>'.$days.'</p>';
                          break;
                          case 6:
                            $this->htmlCale .='<td><p class="text-primary" data-month='.$date->month.'>'.$days.'</p>';
                          break;
                          default:
                            $this->htmlCale .='<td><p data-month='.$date->month.'>'.$days.'</p>';                    }
                    }
                    // 予定が入力された場合の処理
                    foreach ($addplans as $pd) {
                        $startDate = $dt->createFromDate($pd->startDate);
                        $dataY = $startDate->year;
                        $dataM = $startDate->month;
                        $dataD = $startDate->day;

                        if ($date->year === $dataY && $date->month === $dataM &&  $days === $dataD) {
                            $this->htmlCale .= '<span class="plan-item" style="background-color:' . $pd->color .';
                            left:'.$posiM.'%;"></span>';
                            $posiM += 30;
                        }
                    }
                    $posiM = 20;
                    $this->htmlCale .= '</td>';
                }

                if ($days > $daysInMonth && $dayCountar <= 42) {
                    foreach ($holidays as $h) {
                        $hDate = $dt->createFromDate($h['date']);
                        if ($nextDate->year == $hDate->year && $nextDate->month == $hDate->month && $nextMonth == $hDate->day) {
                            $this->htmlCale .='<td data-name='.$h['name'].'><p class="other-week text-danger h" data-month='.$nextDate->month.'>'. $nextMonth .'</p>';
                            $i++;
                            $nextMonth++;
                            $dayCountar++;
                        }
                    }
                    switch ($i) {
                    case 0:
                        $this->htmlCale .= '<td><p class="other-week text-danger" data-month='.$nextDate->month.'>'.$nextMonth .'</p>';
                      break;

                    case 6:
                        $this->htmlCale .= '<td><p class="other-week text-primary" data-month='.$nextDate->month.'>'.$nextMonth .'</p>';
                        break;
                    default:
                        $this->htmlCale .= '<td><p class="other-week" data-month='.$nextDate->month.'>'.$nextMonth .'</p>';
                  }
                    foreach ($addplans as $pd) {
                        $startDate = $dt->createFromDate($pd->startDate);
                        $dataY = $startDate->year;
                        $dataM = $startDate->month;
                        $dataD = $startDate->day;

                        if ($nextDate->year == $dataY && $nextDate->month == $dataM &&  $nextMonth == $dataD) {
                            $this->htmlCale .= '<span class="plan-item" style="background-color:' . $pd->color .';
                            left:'.$posiNextM.'%;"></span>';
                            $posiNextM += 30;
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
        if ($year === null) {
            $year = $dt->year;
            $month = $dt->month;
        }
        $comments = ComentList::whereIn("users_id", [Auth::id(), Auth::user()->partner_id])->orderBy('comentDate', 'asc')->get();
        $csrf = csrf_field();
        $url = action("CalendarController@commentDelete");
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
                  <ul>
                    <li>
                      <div class="d-flex justify-content-between commentInfo">
                        <p class="d-inline">{$cMonth}月{$cDay}日</p>
                        <p>投稿者：{$comment->users->name}</p>
                      </div>
                        <p class="comment-text text-center">{$comment->comentTitle}</p>
                      <div class="likes">
                  EOS;
                if ($comment->like) {
                    for ($i=1; $i <= $comment->like ; $i++) {
                        $this->comentList .= '<img src="./images/like.png" alt="いいね">';
                    }
                }
                $this->comentList .=<<<EOS
                    <form method="post" class="deletBtn d-inline-block" action="{$url}">
                    {$csrf}
                    <input type="hidden" name="id" value="{$comment->id}">
                    <input class="deletePlan" type="submit" value="削除">
                    </form>
                EOS;
            }
            $this->comentList .= '</div></li></ul></div>';
        }
        return $this->comentList .= '</div>';
    }

    private $planList;
    public function planList($year, $month, $clickDay, $clickMonth)
    {
        $dt = new Carbon;
        $authId = Auth::id();
        if ($year === null) {
            $year  = $dt->year;
            $month = $dt->month;
        }
        $date = $dt->createFromDate($year, $month);
        $planDatas = AddPlan::whereIn("users_id", [Auth::id(), Auth::user()->partner_id])->orderBy('startTime', 'asc')->get();
        $csrf = csrf_field();
        $this->planList .="<ul>";
        foreach ($planDatas as $pd) {
            $startDate = $dt->createFromDate($pd->startDate);
            $dataY = $startDate->year;
            $dataM = $startDate->month;
            $dataD = $startDate->day;
            $startT = substr($pd->startTime, 0, 5);
            $endT = substr($pd->endTime, 0, 5);
            $url = action("CalendarController@planDelete");
            if ($date->year == $dataY && $clickMonth == $dataM && $clickDay == $dataD) {
                $this->planList .=<<<EOS
                    <li class="plan-list-items">
                    <div class="plan-list-header">
                    <span class="plan-list-color" style='background-color:{$pd->color};'></span>
                    <div class="plan-list-times">
                    <p>{$startT}</p>
                    <p>{$endT}</p>
                    </div>
                    </div>
                    <div class="plan-list-title">
                    <p>{$pd->planTitle}</p>
                    </div>
                    <form method="post" class="deletBtn" action="{$url}">
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
