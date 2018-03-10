<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class StrawsController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index()
    {
        return view('pages.straws.index');
    }

    public function report() 
    {
        if ($this->request->isMethod('POST')) {

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

    public function searchCompanies()
    {

        $companies = [];

        return response()->json($companies);
    }
}
