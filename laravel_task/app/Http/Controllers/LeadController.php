<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lead;

class LeadController extends Controller
{
    public function submit(Request $request){

        $lead = new Lead();
        $lead->name = $request->input('name');
        $lead->email = $request->input('email');
        $lead->phone = $request->input('phone');
        $lead->wantsToBuy = $request->input('wantsToBuy') == 'on';
        $lead->save();
        return 'Успех!';
    }

    public function getPage(Request $request){
        return view('home', ['data' => Lead::all()]);
    }
}
