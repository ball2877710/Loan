<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RepaymentController extends Controller
{
  public function detail()
  {
      $repayments = DB::table('repayments')->paginate(15);
      return view('detail',['repayments' => $repayments]);
  }
}
