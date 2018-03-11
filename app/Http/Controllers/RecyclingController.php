<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries\Recycling\RecyclingRepository;

use App\Http\Requests;

class RecyclingController extends Controller
{
    protected $request;
    
    public function __construct(Request $request) {
        $this->request = $request;
    }

    public function index(RecyclingRepository $recyclingRepository) {
        
        $success_message = $this->request->session()->get('success_message');

        $centres = $recyclingRepository->all();
        

        return view(
            'pages.recycling.index', 
            [
                'centres' => $centres
            ]
        );


    }
}
