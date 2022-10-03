<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AccountType;
use Illuminate\Http\Request;

class AccountTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.account.index', [
            'accounts' => AccountType::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $request;
        $request->validate([
            'name' => ['required', 'string'],
            'add_money_limit' => ['required'],
            'per_day_money_limit' => ['required'],
            'monthly_limit' => ['required'],
            'tranfer_monthly_max' => ['required'],
            'tranfer_daily_max' => ['required'],
        ]);

        $account = new AccountType;
        $account->name = $request->name;
        $account->add_money_limit = $request->add_money_limit;
        $account->per_day_money_limit = $request->per_day_money_limit;
        $account->monthly_limit = $request->monthly_limit;
        $account->tranfer_monthly_max = $request->tranfer_monthly_max;
        $account->tranfer_daily_max = $request->tranfer_daily_max;
        $account->cashout = $request->cashout;
        $account->commision = $request->commision;
        $account->save();
        return back()->with('success', 'Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $account = AccountType::findorfail($id);
       $view = view('backend.account.show', compact('account'))->render();
       return response()->json(['view' => $view]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $account = AccountType::findorfail($id);
        $view = view('backend.account.edit', compact('account'))->render();
        return response()->json(['view' => $view]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'add_money_limit' => ['required'],
            'per_day_money_limit' => ['required'],
            'monthly_limit' => ['required'],
            'tranfer_monthly_max' => ['required'],
            'tranfer_daily_max' => ['required'],
        ]);
        $account = AccountType::findorfail($id);
        $account->name = $request->name;
        $account->add_money_limit = $request->add_money_limit;
        $account->per_day_money_limit = $request->per_day_money_limit;
        $account->monthly_limit = $request->monthly_limit;
        $account->tranfer_monthly_max = $request->tranfer_monthly_max;
        $account->tranfer_daily_max = $request->tranfer_daily_max;
        $account->cashout = $request->cashout;
        $account->commision = $request->commision;
        $account->save();

        return back()->with('success', 'Edited Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
