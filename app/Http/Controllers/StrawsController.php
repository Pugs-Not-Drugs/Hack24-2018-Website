<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Libraries\Google\GoogleService;
use App\Libraries\EcoNotts\EcoNottsService;

class StrawsController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index(EcoNottsService $ecoNottsService)
    {
        $success_message = $this->request->session()->get('success_message');

        return view('pages.straws.index', ['success_message' => $success_message, 'strawPercentage' => $ecoNottsService->percentage(), 'turtleMarkers' => $ecoNottsService->allWithRatings(), 'turtleFriends' => $ecoNottsService->friends()]);
    }

    public function report(EcoNottsService $ecoNottsService) 
    {        
        if ($this->request->isMethod('POST')) {

            $ecoNottsService->sendReport($this->request->except(['_token', 'company_id']));

            // happy days - flash message
            $this->request->session()->flash(
                'success_message', 
                'Thank you for reporting!'
            );

            return redirect('/');
        }

        // display the form
        return view('pages.straws.report');

    }

    public function searchCompanies(GoogleService $googleService)
    {
        $query = $this->request->input('q');

        $companies = $googleService->searchCompanies($query);

        return response()->json($companies);
    }
}
