<?php
namespace App\Enums\DatabaseEnum;

enum ProductTable
{
    const TABLE = "products";
    const CODE = "code";
    const NAME = "name";
    const DESCRIPTION = "description";
    const MRP = "mrp";
    const COST = "cost";
    const IMAGE = "images";
    
    const CATEGORIES = "category_id";
    const UNIT = "unit_id";
    const FINANCE_YEAR = "finance_year_id";

}
