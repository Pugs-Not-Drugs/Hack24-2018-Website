<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class DashboardController extends Controller
{
    protected $request;
    
    public function __construct(Request $request) {
        $this->request = $request;
    }

    public function index() {
        
        $success_message = $this->request->session()->get('success_message');

        return view('pages.dashboard.index', ['success_message' => $success_message, 'strawPercentage' => rand(0, 100)]);


    }
}
