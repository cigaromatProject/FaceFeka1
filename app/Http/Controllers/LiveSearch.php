<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class LiveSearch extends Controller
{

    function index()
    {
        //return view('live_search');
    }

    function fetch(Request $request)
    {
        if ($request->get('query'))
        {
            $query = $request->get('query');
            $data = DB::table('users')->where('name', 'LIKE', '%{$query}%')
                ->get();
            $result = User::where('name', 'LIKE', '%'. $query. '%')->get();
            echo $result;
            return response()->json($result);
            /* $output = '<ul class="dropdown-menu" style="display.block;
                         position:relative>';
             foreach($data as $row)
             {
                 $output .= '<li><a href="#">'.$row->name.'</a></li>';
             }
             $output .= '</ul>';
             echo $output;*/
        }
    }


}
