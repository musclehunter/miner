<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MineController extends Controller
{
    public function index()
    {
        $mineList = [
          ['name' => '鉱山1'],
          ['name' => '鉱山2'],
          ['name' => '鉱山3'],
        ];
        return view('mine',['mineList'=>$mineList]);
    }
}
