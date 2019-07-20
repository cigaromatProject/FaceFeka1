<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AutoCompleteController extends Controller
{
    public function index(){
        return view('search');
    }

    public function search (Request $request){
        $search = $request->get('term');

        $result = User::where('name', 'LIKE', '%'.$search.'%')->get();

        return response()->json($result);
    }
}
