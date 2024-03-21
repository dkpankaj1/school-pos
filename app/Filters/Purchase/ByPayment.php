<?php

namespace App\Filters\Purchase;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Enums\DatabaseEnum\PurchaseTable;

class ByPayment {
    protected $request;
    public function __construct(Request $request){
        $this->request = $request;
    }

    public function handle(Builder $builder, \Closure $next)
    {
        return $next($builder)->when(
            $this->request->filled('payment_status'), fn($query) => $query->where(PurchaseTable::PAYMENT_STATUS,  $this->request->payment_status )
        );
    }
}
