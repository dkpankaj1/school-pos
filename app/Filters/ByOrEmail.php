<?php

namespace App\Filters;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ByOrEmail {
    protected $request;
    public function __construct(Request $request){
        $this->request = $request;
    }

    public function handle(Builder $builder, \Closure $next)
    {
        return $next($builder)->when(
            $this->request->filled('search'), fn($query) => $query->orWhere('email', 'REGEXP', $this->request->search )
        );
    }
}
