<?php

namespace App\Http\Controllers;

use App\Exceptions\BalanceTooLowException;
use App\Models\Record;
use App\Models\Show;
use App\Models\Token;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
/*    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $actions = ['index', 'profile'];
            foreach ($actions as $action) {
//                if ($request->route()->getActionMethod() === $action && !Gate::allows('home-' . $action)) {
//                    abort(403);
//                }
            }
            return $next($request);
        });
    }*/

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request, $id = null)
    {

        return view('home',[]);
    }

    public function info(Request $request, $id = null)
    {

        $token = Token::where('token',$id)->first();
        $student = $token->student ?? [];
        if (!is_null($token)) {
            Show::create([
                'token_id' => $token->id,
            ]);
        }
        return view('info',[
            'student' => $student
        ]);
    }

    public function profile()
    {
        if (true){
            throw new BalanceTooLowException();
        }
        $record = Record::find(1);
        dd($record->assignments, $record->attendances);
        return view('profile');
    }
}
