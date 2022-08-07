<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Company;
use App\Application;
use App\Category;
use App\JobField;
use App\User;

class DashboardController extends Controller
{


  public function dashboard(Request $request)
  {
    if (Session::has('userId')) {
      $userId = User::where('id', '=', Session::get('userId'))->first();
    }

    $pageConfigs = ['pageHeader' => false];

    $newApplicationCount = Application::where('status', 1)->count();
    $CompletedApplicationCount = Application::where('status', 2)->count();
    $companyCount = Company::get()->count();
    $companies = Company::orderBy('id', 'desc')->take(10)->get();
    $applications = Application::where('status', 1)->orderBy('id', 'desc')->take(10)->get();
    $categoryCount = Category::where('status', 1)->count();
    $jobFieldCount = JobField::where('status', 1)->count();



    return view('/content/dashboard/dashboard', [
      'pageConfigs' => $pageConfigs,
      'userId' => $userId,
      'newApplicationCount' => $newApplicationCount,
      'CompletedApplicationCount' => $CompletedApplicationCount,
      'companyCount' => $companyCount,
      'categoryCount' => $categoryCount,
      'jobFieldCount' => $jobFieldCount,
      'companies' => $companies,
      'applications' => $applications,

    ]);
  }
}
