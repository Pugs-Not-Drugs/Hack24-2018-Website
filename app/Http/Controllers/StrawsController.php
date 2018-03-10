<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Libraries\Bing\BingService;
use App\Libraries\EcoNotts\EcoNottsService;

class StrawsController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index()
    {
        $success_message = $this->request->session()->get('success_message');

        return view('pages.straws.index', ['success_message' => $success_message]);
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

            return redirect('/straws');
        }

        // display the form
        return view('pages.straws.report');

    }

    public function searchCompanies(BingService $bingService)
    {
        $query = $this->request->input('q');

        $companies = $bingService->searchCompanies($query);

        return response()->json($companies);
    }
}
