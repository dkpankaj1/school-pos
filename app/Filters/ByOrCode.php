<?php

namespace App\Filters;
use App\Enums\DatabaseEnum\ProductTable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ByOrCode {
    protected $request;
    public function __construct(Request $request){
        $this->request = $request;
    }

    public function handle(Builder $builder, \Closure $next)
    {
        return $next($builder)->when(
            $this->request->filled('search'), fn($query) => $query->orWhere('code', 'REGEXP',$this->request->search)
        );
    }
}
