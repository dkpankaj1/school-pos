<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Pipeline;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
        // $pipelines = [

        //     function (Builder $builder, \Closure $next) use ($request) {
            
        //         return $next($builder)->when(
        //             $request->filled("email"),
        //             fn($query) => $query->where("email","like","%". $request->email ."%")
        //         );
        //     }
        // ];

        // return Pipeline::send(User::query())
        //     ->through($pipelines)
        //     ->thenReturn()
        //     ->get();

    }
}
