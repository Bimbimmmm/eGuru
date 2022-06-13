<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalaryIncrease;

class DivisionHeadSalaryIncreaseController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
      $all_datas=SalaryIncrease::where(['is_deleted' => FALSE])->get();
      return view('head_division/salaryincrease/index', compact('all_datas'));
    }
}
