<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Calendar;
use App\Models\AddPlan;
use App\Models\User;
use App\Models\ComentList;
use Carbon\Carbon;

class CalendarController extends Controller
{
    public function addPlan(Request $request)
    {
        $this->validate($request, AddPlan::$rules);
        $addPlan = new AddPlan;
        $form = $request->all();
        unset($form['_token']);
        $addPlanDatas = $addPlan->fill($form)->save();
        //ここもユーザーIDを入れないといけないな
        return redirect('/calendar');
    }

    public function comentList(Request $request)
    {
        $this->validate($request, ComentList::$rules);
        $addPlan = new ComentList;
        $form = $request->all();
        unset($form['_token']);
        $addPlanDatas = $addPlan->fill($form)->save();
        //ここもユーザーIDを入れないといけないな
        return redirect('/calendar');
    }

    public function planList_ajax(Request $request)
    {
      // 予定一覧表示（工事中）
        $obj = new Calendar;
        $cal_planList = $obj->planList($request->year, $request->month, $request->clickNum);
        return $request->clickNum;
    }

    public function profileUpDate(Request $request) {

        $user_form = $request->all();
        $user = Auth::user();
        unset($user_form['_token']);
        $user->fill($user_form)->save();
        return redirect('/calendar/{user_id}');
    }

    public function showCale(Request $request, $user_id)
    {
        $obj = new Calendar;
        $carbon = new Carbon();
        $tableUsers = DB::table('users');
        if (isset($tableUsers)) {
            $id_tableUser = $tableUsers->select('id')->get();
            $t_users = DB::table('users');
        }
        $user_id = $id_tableUser;
        $cal = $obj->showCale($request->year, $request->month);
        $cal_changeMonth = $obj->changeMonth($request->year, $request->month, $user_id);
        $cal_comentList = $obj->comentList($request->year, $request->month);

        return view('calendar', [
        "cal" => $cal,
        "changeMonth" => $cal_changeMonth,
        "comentList" => $cal_comentList,
        "user_id" => $user_id,
        "user" => Auth::user(),
        "today" => $carbon,
       ]);
    }
}
