<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\JobField;
use App\Category;

class JobFieldsController extends Controller
{
    public function index()
    {

        $jobFields = JobField::with('category')->get();
     
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['name' => "Job Fields"]
        ];
  
        return view('/content/job-fields/index', [
            'breadcrumbs' => $breadcrumbs,
            'jobFields' => $jobFields,
           
        ]);

    }
    public function addJob_Fields(){

        $categories = Category::with('jobField')->get();
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['name' => "Job-fields"], ['name' => "Add Job-fields"]
        ];
  
        return view('/content/job-fields/add-job-fields', [
            'breadcrumbs' => $breadcrumbs,
            'categories' => $categories
        ]);

    }

    public function createJob_Fields(Request $request){

        $JobFields = new JobField();
        // dd($JobFields);
        $JobFields->job_field_name = $request->job_field_name;
        $JobFields->category_id = $request->category_id;
        $JobFields->status = 1;

        
      
        
        $JobFields->save();
      
          return redirect()->back()->with('success', 'JobField added successfully !!!');

       $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['name' => "Category"], ['name' => "Add Job Field"]
       ];
  
        return view('/content/job-fields/add-job-fields', [
            'breadcrumbs' => $breadcrumbs,
         ]);

    }


    public function editJob_Fields($id){

        $jobfields = JobField::find($id);
        $categories = Category::get();

        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['name' => "Job Fields"], ['name' => "Edit Job Field"]
        ];
  
        return view('/content/job-fields/edit-job-fields', [
            'breadcrumbs' => $breadcrumbs,
            'jobfields' => $jobfields,
            'categories' => $categories

        ]);

    }

     public function updatejob_fields(Request $request)
     {
      
        JobField::where('id', $request->job_field_id)->update([

            'job_field_name' => $request->job_field_name,
            'category_id' => $request->category_id,
            'status' => 1


        ]);

  
      return redirect()->back()->with('success', ' Job field updated successfully !!! ');

    }

        public function inactivatejob_fields($id)
        {
            $JobFields = JobField::find($id);
            $JobFields->status = 0;
            $JobFields->update();
    
        return redirect()->back()->with('success', 'Job field inactivated successfully !!!');
        }

        public function activatejob_fields($id)
        {
            $JobFields = JobField::find($id);
            $JobFields->status = 1;
            $JobFields->update();

        return redirect()->back()->with('success', 'Job field activated successfully !!!');
        }


}
