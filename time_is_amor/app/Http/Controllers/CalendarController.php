<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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
        return redirect('/calendar');
    }

    public function comentList(Request $request)
    {
        $this->validate($request, ComentList::$rules);
        $addPlan = new ComentList;
        $form = $request->all();
        unset($form['_token']);
        $addPlanDatas = $addPlan->fill($form)->save();
        return redirect('/calendar');
    }

    public function planList_ajax(Request $request)
    {
        $obj = new Calendar;
        $cal_planList = $obj->planList($request->year, $request->month, $request->clickNum);
        return $request->clickNum;
    }

    public function showCale(Request $request, $user_id)
    {
        $obj = new Calendar;
        $cal = $obj->showCale($request->year, $request->month);
        $cal_changeMonth = $obj->changeMonth($request->year, $request->month);
        $cal_comentList = $obj->comentList($request->year, $request->month);

        $tableUsers = DB::table('users');
        if (isset($tableUsers)) {
            $id_tableUser = $tableUsers->select('id')->get();
            $tableUser = $tableUsers->get();
        }
        $user_id = $id_tableUser;

        return view('calendar', [
        "cal" => $cal,
        "changeMonth" => $cal_changeMonth,
        "comentList" => $cal_comentList,
        "user_id" => $user_id,
        "infos_user" =>$tableUser,
       ]);
    }
}
