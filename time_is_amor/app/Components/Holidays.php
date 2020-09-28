<?php
namespace App\Components;

use Carbon\Carbon;

class Holidays
{
    public function holidays()
    {
        $startDt = new Carbon;
        $endDt = new Carbon;
        $api_key = "";
        $calendar_id = urlencode('japanese__ja@holiday.calendar.google.com');
        $start = date($startDt->year.'-01-01\T00:00:00\Z');
        $end = date($endDt->year.'-12-31\T00:00:00\Z');
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
        $holidays =[];
        if ($datas = file_get_contents($complete_url, true)) {
            $datas = json_decode($datas);
        $i = 0;
        foreach ($datas->items as $data) {
            $holidays[$i] = array(
          'date' => $data->start->date,
          'name' => $data->summary,
        );
            $i++;
        }
      }
        return $holidays;
    }
}
