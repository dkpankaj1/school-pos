<?php

namespace App\Filters\Purchase;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Enums\DatabaseEnum\PurchaseTable;

class BySupplier {
    protected $request;
    public function __construct(Request $request){
        $this->request = $request;
    }

    public function handle(Builder $builder, \Closure $next)
    {
        return $next($builder)->when(
            $this->request->filled('supplier'), fn($query) => $query->where(PurchaseTable::SUPPLIER_ID,  $this->request->supplier )
        );
    }
}
