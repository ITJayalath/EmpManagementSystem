<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;

class CompanyController extends Controller
{
    public function companies(){
      $companies = Company::get();

        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['name' => "Companies"]
          ];
          return view('/content/company/companies',[
            'breadcrumbs' => $breadcrumbs,
            'companies'   => $companies,
  
          ]);
    }
}
