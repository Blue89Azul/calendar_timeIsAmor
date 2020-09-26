<?php
namespace App\Components;

use Carbon\Carbon;

class Holidays
{
    public function holidays()
    {
        $dt = new Carbon;
        $api_key = "";
        $calendar_id = urlencode('japanese__ja@holiday.calendar.google.com');
        $start = $dt->firstOfYear();
        $end = $dt->endOfYear();
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
        $datas =[];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $complete_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $holidays = json_decode(curl_exec($ch));
        $i = 0;
        foreach ($holidays->items as $holiday) {
            $datas[$i] = array(
          'date' => $holiday->start->date,
          'name' => $holiday->summary,
        );
            $i++;
        }
        curl_close($ch);
        return $datas;
    }
}
