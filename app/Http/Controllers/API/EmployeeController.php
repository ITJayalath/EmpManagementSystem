<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Employee;
use App\Company;
use App\Leave;


class EmployeeController extends Controller
{
    //
    function employeeRegister(Request $request){
        $employee = new Employee();
        $employee->name = $request->name;
        $employee->profile_photo = $request->profile_photo;
        $employee->company_id = $request->company_id;
        $employee->dob = $request->dob;
        $employee->emirates_id = $request->emirates_id;
        $employee->contract_start_date = $request->contract_start_date;    
        $employee->save();
        return json_encode('Employee saved!');
    }

    public function getEmployee()
    {
        $company = Employee::all();

        return json_encode($company);
    }


    public function deleteEmployee($id)
    {
        $task = Employee::findOrFail($id);
        $result = $task->delete();
        if($result){
            return json_encode('Deleted successfully.');
        }
        else{
            return json_encode('Deleted Unsuccesfull');
        }
    }

    public function employeeLeave(Request $request){
        $existingemployee = Employee::where('id', $request->id)->first();
        if($existingemployee){
            $joindate = $existingemployee->contract_start_date;
            $currntDate = new DateTime();
            $to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i',   $joindate);
            $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i',  $currntDate);
            $diff_in_months = $to->diffInMonths($from);
            if($diff_in_months>6){
                $leave = new Leave();
                $leave->employee_id = $existingemployee->id;
                $leave->name = $existingemployee->name;
                $leave->leave_reason = $request->leave_reason;
                $leave->start_date = $request->start_date;
                $leave->end_date = $request->end_date;
                $leave->save();
                return json_encode('Leave approved');
            }
            else{
                return json_encode('NotEligible to Get a Leave');
            }

        }
    }
}
