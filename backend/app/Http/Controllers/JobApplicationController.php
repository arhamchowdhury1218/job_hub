<?php

namespace App\Http\Controllers;
use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Validator;

class JobApplicationController extends Controller
{
    public function apply(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:157',
            
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

       
        $application = JobApplication::create([
            'job_id' => $id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            

            
        ]);

        

        return response()->json(['message' => 'Application submitted successfully!', 'application' => $application], 201);
    }
    public function getApplicants($id)
    {
        $job = Job::with('applications')->findOrFail($id); 
        return response()->json($job->applications); 
    }




}
