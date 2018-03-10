<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries\Pollution\PollutionService;

use App\Http\Requests;

class DashboardController extends Controller
{
    protected $request;
    
    public function __construct(Request $request) {
        $this->request = $request;
    }

    public function index(PollutionService $pollutionService, \App\Libraries\Foodbank\FoodBankRepository $foodBankRepository) {
        
        $success_message = $this->request->session()->get('success_message');
        $pollutionData = $pollutionService->get();

        $foodbankNeeds = $foodBankRepository->neededItems();
        

        return view(
            'pages.dashboard.index', 
            [
                'success_message' => $success_message, 
                'strawPercentage' => rand(0, 100), 
                'pollutionData' => $pollutionData,
                'foodbankNeeds' => $foodbankNeeds
            ]
        );


    }
}
