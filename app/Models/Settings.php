<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\DatabaseEnum\SettingTable;

class Settings extends Model
{
    use HasFactory;
    protected $fillable = [
        SettingTable::COMPANY,
        SettingTable::PHONE,
        SettingTable::COMPANY,
        SettingTable::EMAIL,
        SettingTable::ADDRESS,
        SettingTable::CITY,
        SettingTable::STATE,
        SettingTable::COUNTRY,
        SettingTable::LOGO,
        SettingTable::FAVICON,
        SettingTable::CURRENCY_CODE,
        SettingTable::CURRENCY_SYMBOL,
        SettingTable::DEFAULT_FINANCE_YEAR,
    ];

    public function finance_year()
    {
        return $this->belongsTo(FinanceYears::class);
    }
}
