<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
use App\Models\Seller;
use Illuminate\Support\Facades\Validator;

class SellerService {
    public $appSettingService;

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function checkExistingPortfolio($request) {
        $portfolioExists = Seller::where('portfolio', 'LIKE', '%'.$request->portfolio.'%')->first();

        // $validation_errors = $validatedRequest->errors();
        if ($portfolioExists) {
            return response()->json(['message' => 'Portfolio already exists']);
        }

        // If no errors and portfilio url did not exist return 200 response
        return response('', 200)
            ->header('Content-Type', 'application/json');
    }
    
    /**
     * Create new seller
     * @param Request $request
     * @throws Exception
     */
    public function create(Request $request) {

        $validatedRequest = Validator::make($request->all(), [
            'first_name' => 'required|string|min:1|max:255',
            'last_name' => 'required|string|min:3|max:255',
            'portfolio' => 'required|unique:sellers',
            'online_stores' => 'nullable|string',
            'category' => 'integer',
            'perspective' => 'integer',
            'experience' => 'integer',
            'understanding' => 'integer',
        ]);

        $validation_errors = $validatedRequest->errors();
        if ($validation_errors->any()) {
            return response($validation_errors, 200)
                ->header('Content-Type', 'application/json');
        }

        try {
            $data = Seller::create($request->all());
            return response($data, 201)
                ->header('Content-Type', 'application/json');
        } catch (\Exception $e)
        {
            $errorCode = $e->errorInfo[1];
            if($errorCode == 1062){
                $error = "{'error': 'Portfolio Already Exists'}";
                return response($error, 403)
                    ->header('Content-Type', 'application/json');
            }
        }
    }
 
}
