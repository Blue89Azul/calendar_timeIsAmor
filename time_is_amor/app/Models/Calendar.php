<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\AddPlan;
use Carbon\Carbon;

class Calendar extends Model
{
    private $holidays;
    public function holidays()
    { // googleカレンダーAPIによる祝日の取得
        $api_key = "AIzaSyAgPogpsvPDZpQZN4T9MzwP48R8vmc5Vjg";
        $calendar_id = urlencode('japanese__ja@holiday.calendar.google.com');
        $start = new Carbon('2020-01-01 00:00:00');
        $end = new Carbon('2020-12-31 00:00:00');
        $url = "https://www.googleapis.com/calendar/v3/calendars/". $calendar_id . "/events?";
        $query = [
        'key' => $api_key,
        'timeMin' => $start,
        'timeMax' => $end,
        'maxResult' => 50,
        'orderBy' => 'startTime',
        'singleEvents' =>'true'
      ];
        $complete_url = $url . http_build_query($query);
        $this->holidays =[];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $complete_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $datas = json_decode(curl_exec($ch));
        curl_close($ch);

        // foreach ($datas->items as $data) {
        //     $this->holidays[$data->start->date] = $data->summary;
        // }
    }

    private $htmlCale;
    public function showCale($year, $month)
    {
        $dt = new Carbon;
        $tableAddPlan = DB::table('add_plans');
        if (isset($tableAddPlan)) {
            $planDatas = $tableAddPlan->get();
        }
        if ($year === null) {
            $y = $dt->year;
            $m = $dt->month;
        }
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

        $this->htmlCale = <<<EOS
    <table class="calendar__table">
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
                    $this->htmlCale .='<td><p class="other-week">'. $d .'</p>';
                    foreach ($planDatas as $pd) {
                        $dataY = $dt->createFromDate($pd->startDate)->year;
                        $dataM = $dt->createFromDate($pd->startDate)->month;
                        $dataD = $dt->createFromDate($pd->startDate)->day;
                        if ($subDate->year === $dataY && $subDate->month === $dataM &&  $d === $dataD) {
                            $this->htmlCale .= '<span style="background-color:' . $pd->color .'; "></span>';
                        }
                    }
                    $this->htmlCale .= '</td>';
                }
                if ($days >= 1 && $days <= $daysInMonth) {
                    $this->htmlCale .='<td><p>'.$days.'</p>';
                    foreach ($planDatas as $pd) {
                        $dataY = $dt->createFromDate($pd->startDate)->year;
                        $dataM = $dt->createFromDate($pd->startDate)->month;
                        $dataD = $dt->createFromDate($pd->startDate)->day;
                        if ($date->year == $dataY && $date->month == $dataM &&  $days == $dataD) {
                            $this->htmlCale .= '<span style="background-color:'. $pd->color .';"></span>';
                        }
                    }
                    $this->htmlCale .= '</td>';
                }

                if ($days > $daysInMonth && $dayCountar <= 42) {
                    $this->htmlCale .= '<td><p class="other-week">'.$nextMonth .'</p>';
                    foreach ($planDatas as $pd) {
                        $dataY = $dt->createFromDate($pd->startDate)->year;
                        $dataM = $dt->createFromDate($pd->startDate)->month;
                        $dataD = $dt->createFromDate($pd->startDate)->day;
                        if ($nextDate->year == $dataY && $nextDate->month == $dataM &&  $nextMonth == $dataD) {
                            $this->htmlCale .= '<span style="background-color:'. $pd->color .';"></span>';
                        }
                    }
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

        $date = $dt->createFromDate($year, $month);
        $subY = $date->subMonth()->year;
        $subM = $date->subMonth()->month;
        $addY = $date->addMonth()->year;
        $addM = $date->addMonth()->month;

        $this->changeMonth =<<<EOS
      <div class="col-6 calendar-title">
          <a href="/calendar?year={$subY}&month={$subM}" class="arrow-pre"></a>
            <h1 class="this-month">
              <span>{$year}</span>
              <span>{$month}</span>
            </h1>
          <a href="/calendar?year={$addY}&month={$addM}" class="arrow-next"></a>
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
        $tableComentList = DB::table('coment_lists');
        if (isset($tableComentList)) {
            $clDatas = $tableComentList->get();
        }

        $this->comentList .=<<<EOS
                    <div class="modal-header coment-list__header">
                    <h5>DONE FOR US<span>{$year}. {$month}</span></h5>
                    </div>
                    <div class="modal-body">
                    <div class="card col-11 mx-auto">
                    <ul class="list-group list-group-flush">
                    EOS;
        foreach ($clDatas as $data) {
            $cMonth = $dt->createFromDate($data->comentDate)->month;
            $cDay = $dt->createFromDate($data->comentDate)->day;
            $this->comentList .=<<<EOS
                  <li class="list-group-item">
                  <div class="coment-date d-inline-block">
                  <p class="d-inline">{$cMonth}月{$cDay}日</p>
                  <span>まりも</span> → <span>くまモン</span>
                  </div>
                  <div class="likes d-inline-block">
                  EOS;
            if (isset($data->like)) {
                for ($i=1; $i <= $data->like ; $i++) {
                    $this->comentList .= '<img src="img/like.png" alt="いいね">';
                }
            }
            $this->comentList .= '</div><p class="main-coment text-center">'.$data->comentTitle.'</p></li>';
        }

        return $this->comentList .= '</ul></div></div>';
    }
}
