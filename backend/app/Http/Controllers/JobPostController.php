<?php

namespace App\Http\Controllers;
use App\Models\JobPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobPostController extends Controller
{
   
    public function store(Request $request)
    {
       
        $validated = $request->validate([
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

      
        $job = JobPost::create([ 
            'type' => $validated['type'],
            'title' => $validated['title'],
            'description' => $validated['description'],
            'salary' => $validated['salary'],
            'location' => $validated['location'],
            'company_name' => $validated['company']['name'],
            'company_description' => $validated['company']['description'],
            'contact_email' => $validated['company']['contactEmail'],
            'contact_phone' => $validated['company']['contactPhone'],
            // 'account_id' => Auth::guard('account')->id(),
            'account_id' => Auth::guard('account')->id(),
            // 'account_id' => 4,
            // dd(Auth::id())
        ]);

        
        return response()->json(['message' => 'Job created successfully!', 'job' => $job], 201);
    }


    
    public function index()
    {
        $posts = JobPost::get();
        return response()->json(["posts" => $posts, "message" => "Hello"]);
    }
}
