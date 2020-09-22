<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
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

    public function planListAjax(Request $request)
    {
        $cal_planList = Calendar::planList($request->year, $request->month, $request->clickNum);
        return redirect('/calendar',[
          'planList' => $cal_planList,
          ]);
    }

    public function profileUpdate(Request $request)
    {
        $user_form = $request->all();
        $user = new User;
        unset($user_form['_token']);
        $user->fill($user_form)->save();
        return redirect('/calendar');
    }

    public function show(Request $request)
    {
        $obj = new Calendar;
        $cal = $obj->showCale($request->year, $request->month);
        $cal_changeMonth = $obj->changeMonth($request->year, $request->month);
        $cal_comentList = $obj->comentList($request->year, $request->month);
        return view('calendar', [
        "cal" => $cal,
        "changeMonth" => $cal_changeMonth,
        "comentList" => $cal_comentList,
        "user_id" => Auth::id(),
        "user" => Auth::user(),
        "today" => new Carbon(),
       ]);
    }

}
