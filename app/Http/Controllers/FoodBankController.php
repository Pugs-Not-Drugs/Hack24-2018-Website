<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries\Pollution\PollutionService;

use App\Http\Requests;

class FoodBankController extends Controller
{
    protected $request;
    
    public function __construct(Request $request) {
        $this->request = $request;
    }

    public function index(PollutionService $pollutionService, \App\Libraries\Foodbank\FoodBankRepository $foodBankRepository) {
        
        $success_message = $this->request->session()->get('success_message');

        $foodbanks = $foodBankRepository->all();
        

        return view(
            'pages.foodbanks.index', 
            [
                'foodbanks' => $foodbanks
            ]
        );


    }
}
