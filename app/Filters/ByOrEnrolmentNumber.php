<?php

namespace App\Filters;
use App\Enums\DatabaseEnum\StudentTable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ByOrEnrolmentNumber {
    protected $request;
    public function __construct(Request $request){
        $this->request = $request;
    }

    public function handle(Builder $builder, \Closure $next)
    {
        return $next($builder)->when(
            $this->request->filled('search'), fn($query) => $query->orWhere(StudentTable::ENROLMENT_NO, 'REGEXP',$this->request->search)
        );
    }
}
