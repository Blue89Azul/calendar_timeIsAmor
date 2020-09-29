<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Components\Holidays;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Calendar;
use App\Models\AddPlan;
use App\User;
use App\Models\Users;
use App\Models\ComentList;
use Carbon\Carbon;

class CalendarController extends Controller
{
    protected $provider;
    public function __construct(Holidays $holidays)
    {
        $this->provider = $holidays->holidays();
    }

    public function addPlan(Request $request)
    {
        $this->validate($request, AddPlan::$rules);
        $addPlan = new AddPlan;
        $form = $request->all();
        $form['users_id'] = Auth::id();
        unset($form['_token']);
        $addPlanDatas = $addPlan->fill($form)->save();
        return redirect('/calendar');
    }

    public function comentList(Request $request)
    {
        $this->validate($request, ComentList::$rules);
        $addPlan = new ComentList;
        $form = $request->all();
        $form['users_id'] = Auth::id();
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
        if (isset($user_form['iconImage'])) {
            $path_icon = $request->file('iconImage')->store('public/img');
            $user->iconImg = basename($path_icon);
            unset($user_form['iconImage']);
        }
        if (isset($user_form['bgImage'])) {
            $path_bg = $request->file('bgImage')->store('public/img');
            $user->bgImg = basename($path_bg);
            unset($user_form['bgImage']);
        }

        unset($user_form['_token']);
        $user->fill($user_form)->save();
        return redirect('/calendar');
    }

    public function balloonAjax(Request $request)
    {
        $user = Auth::user();
        $form = $request->all();
        $form['balloonStatus'] = (intval($request->status));
        unset($form['_token']);
        $user->fill($form)->save();
        return redirect('/calendar');
    }

    public function planDelete(Request $request)
    {
      $plan = addPlan::find($request->id);
      $plan->delete();
      return redirect('/calendar');
    }

    public function show(Request $request)
    {
        $obj = new Calendar;
        $authUser = Auth::user();
        $authId = Auth::id();
        $likeCounter = Users::find($authId)->comentlists->sum('like');
        $animeFlag = intval($likeCounter / 3);
        empty(User::find($authUser->partner_id))? $partner = 0 : $partner = User::find($user->partner_id) ;

        $cal = $obj->showCale($request->year, $request->month, $this->provider);
        $cal_changeMonth = $obj->changeMonth($request->year, $request->month);
        $cal_comentList = $obj->comentList($request->year, $request->month);

        return view('calendar', [
        "cal" => $cal,
        "changeMonth" => $cal_changeMonth,
        "comentList" => $cal_comentList,
        "holidays" => $this->provider,
        "animeFlag" => $animeFlag,
        "partner" => $partner,
        "user_id" => $authId,
        "user" => $authUser,
        "today" => new Carbon(),
       ]);
    }
}
