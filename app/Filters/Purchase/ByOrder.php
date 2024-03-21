<?php

namespace App\Filters\Purchase;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Enums\DatabaseEnum\PurchaseTable;

class ByOrder {
    protected $request;
    public function __construct(Request $request){
        $this->request = $request;
    }

    public function handle(Builder $builder, \Closure $next)
    {
        return $next($builder)->when(
            $this->request->filled('order_status'), fn($query) => $query->where(PurchaseTable::ORDER_STATUS,  $this->request->order_status )
        );
    }
}
