<?php

namespace App\Filters\Purchase;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Enums\DatabaseEnum\PurchaseTable;

class ByDate {
    protected $request;
    public function __construct(Request $request){
        $this->request = $request;
    }

    public function handle(Builder $builder, \Closure $next)
    {
        return $next($builder)->when(
            $this->request->filled('purchase_date'), fn($query) => $query->whereDate(PurchaseTable::DATE,  $this->request->purchase_date )
        );
    }
}
