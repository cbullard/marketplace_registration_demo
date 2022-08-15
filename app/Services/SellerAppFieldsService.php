<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
use App\Models\SellerApplicationFields;

class SellerAppFieldsService {
    public $appSettingService;

    
    public function getApplicationFieldsText() {
        $data = SellerApplicationFields::orderBy('order', 'desc')->get()->groupBy('group');

        return response($data, 200)
        ->header('Content-Type', 'application/json');
    }
 
}
