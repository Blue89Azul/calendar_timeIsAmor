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
        $year = Carbon::now()->year;
        $month = Carbon::now()->month;
        $obj = new Calendar;
        $cal = $obj->planList($year, $month, $request->clickNum);

        return response()->json($cal);
    }

    public function profileUpdate(Request $request)
    {
        $user_form = $request->all();
        $user = Auth::user();

        if (isset($user_form['image'])) { //アイコン画像
            $path = $request->file('image')->store('public/image');
            $user->image_path = basename($path);
            unset($user_form['image']);
        }
        if (isset($user_form['image'])) {　//背景画像
            $path = $request->file('image')->store('public/image');
            $user->image_path = basename($path);
            unset($user_form['image']);
        }

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
