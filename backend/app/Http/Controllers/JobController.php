<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{


    public function store(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'type' => 'required|string',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'salary' => 'required|string',
            'location' => 'required|string',
            'company.name' => 'required|string|max:255',
            'company.description' => 'nullable|string',
            'company.contactEmail' => 'required|email',
            'company.contactPhone' => 'nullable|string',
        ]);

        // Create a new job entry with the authenticated user's account_id
        $job = Job::create([
            'type' => $request->type,
            'title' => $request->title,
            'description' => $request->description,
            'salary' => $request->salary,
            'location' => $request->location,
            'company_name' => $request->company['name'],
            'company_description' => $request->company['description'],
            'contact_email' => $request->company['contactEmail'],
            'contact_phone' => $request->company['contactPhone'],
            'account_id' => auth()->user()->id, // Set account_id to the currently authenticated user's ID
        ]);

        // Return a response
        return response()->json(['message' => 'Job created successfully!', 'job' => $job], 201);
    }


    public function index()
    {
        $jobs = Job::all();
        return response()->json($jobs);
    }



    public function destroy($id)
    {
        // Find the job by ID
        $job = Job::find($id);

        // Check if the job exists
        if (!$job) {
            return response()->json(['message' => 'Job not found'], 404);
        }

        // Delete the job
        $job->delete();

        // Return a response
        return response()->json(['message' => 'Job deleted successfully'], 200);
    }

    public function show($id)
    {
       
        $job = Job::find($id);

       
        if ($job) {
            return response()->json([
                'type' => $job->type,
                'title' => $job->title,
                'description' => $job->description,
                'salary' => $job->salary,
                'location' => $job->location,
                'companyName' => $job->company_name,
                'companyDescription' => $job->company_description,
                'contactEmail' => $job->contact_email,
                'contactPhone' => $job->contact_phone,
            ]);
        } else {
            return response()->json(['message' => 'Job not found'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'string|max:255',
            'description' => 'string',
            'salary' => 'string',
            'location' => 'string',
            'type' => 'string',
            'company.name' => 'string',
            'company.description' => 'nullable|string',
            'company.contactEmail' => 'email',
            'company.contactPhone' => 'nullable|string',
        ]);

        $job = Job::findOrFail($id);

        
        $job->title = $request->input('title');
        $job->description = $request->input('description');
        $job->salary = $request->input('salary');
        $job->location = $request->input('location');
        $job->type = $request->input('type');

        
        if ($request->has('company')) {
            $job->company_name = $request->input('company.name');
            $job->company_description = $request->input('company.description');
            $job->contact_email = $request->input('company.contactEmail');
            $job->contact_phone = $request->input('company.contactPhone');
        }

        $job->save(); 

        return response()->json(['message' => 'Job updated successfully!']);
    }

    // public function showJob($id)
    // {
    //     $job = Job::findOrFail($id);
    //     return response()->json($job);
    // }

    public function getJobsByAdmin()
    {
        $jobs = Job::where(column: 'account_id', operator: auth()->user()->id)->get();
        return response()->json($jobs);
    }




}
