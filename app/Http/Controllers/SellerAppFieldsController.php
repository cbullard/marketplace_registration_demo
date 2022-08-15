<?php

namespace App\Http\Controllers;

// use App\Models\SellerApplicationFields;
// use Illuminate\Http\Request;
use App\Services\SellerAppFieldsService;


class SellerAppFieldsController extends Controller
{
    private $sellerFieldService;

    public function __construct(SellerAppFieldsService $sellerFieldService) {
        $this->sellerFieldService = $sellerFieldService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->sellerFieldService->getApplicationFieldsText();
    }
}
