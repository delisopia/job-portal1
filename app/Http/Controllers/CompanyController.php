<?php

namespace App\Http\Controllers;
use App\Models\Company;
use Illuminate\Http\Request;



class CompanyController extends Controller
{public function show($id)
    {
        $company = Company::findOrFail($id);
        return view('companies.show', compact('company'));
    }
}
