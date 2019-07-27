<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('search.search');
    }


    public function searchAjax($value)
    {
        $users = User::where('name', 'like', '%'.$value.'%')->where('id', '!=', Auth::id())->get();

        $output = '';
        if(!$users->isEmpty()){
            foreach($users as $user){
                if($user->profile->image){
                    if($user->profile->title){
                        $output .=  '<li><a href="'.url('profile', $user->id).'"><div class="media"><img class="mr-3" src="'.asset($user->profile->image).'" width="50" height="50"><div class="media-body"><h6 class="mt-0">'.$user->name.'.</h6>'.$user->profile->title.'</div></div></a></li>';
                    }else{
                        $output .=  '<li><a href="'.url('profile', $user->id).'"><div class="media"><img class="mr-3" src="'.asset($user->profile->image).'" width="50" height="50"><div class="media-body"><h6 class="mt-0">'.$users->name.'.</h6></div></div></a></li>';
                    }
                }else{
                    if($user->profile->title){
                        $output .=  '<li><a href="'.url('profile', $user->id).'"><div class="media"><img class="mr-3" src="'.asset('images/userdummy.jpg').'" width="50" height="50"><div class="media-body"><h6 class="mt-0">'.$user->name.'.</h6>'.$user->profile->title.'</div></div></a></li>';
                    }else{
                        $output .=  '<li><a href="'.url('profile', $user->id).'"><div class="media"><img class="mr-3" src="'.asset('images/userdummy.jpg').'" width="50" height="50"><div class="media-body"><h6 class="mt-0">'.$user->name.'.</h6></div></div></a></li>';
                    }
                }
            }
        }
        return $output;
    }


    public function search(Request $request)
    {
        $query = $request->q;
        if ($request->q == '*') {
            $users = User::all();
        } else
            $users = User::where('name', 'like', '%'.$request->q.'%')->where('id', '!=', Auth::id())->get();

        return view('search', compact('users', 'query'));
    }

}

