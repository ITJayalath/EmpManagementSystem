<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Company;
use App\login;

class CompanyController extends Controller
{
    //
    function expectemp(Request $request){
        $company = new Company();
        $company->name = $request->name;
        $company->save();
        return json_encode('Compnay saved!');
    }

    public function getCompanies()
    {
        $company = Company::all();

        return json_encode($company);
    }

    public function deleteUsers($id)
    {
      $users = Company::find($id);

      $users->delete();

      return json_encode('success', 'Deleted successfully.');
                     
    }

    public function delete($id)
    {
        $task = Company::findOrFail($id);
        $result = $task->delete();
        if($result){
            return json_encode('Deleted successfully.');
        }
        else{
            return json_encode('Deleted Unsuccesfull');
        }
    }
}
