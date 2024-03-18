<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Settings;
use Spatie\Image\Image;
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    protected $settings;
    protected $imageManager;
    public function __construct()
    {
        $this->settings = Settings::first();
        $this->imageManager = Image::useImageDriver('gd');
    }


    public function getFinanceYear()
    {
        return $this->settings->finance_year_id;
    }
}
