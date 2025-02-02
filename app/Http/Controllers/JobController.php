<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class JobController extends Controller
{
    public function index()
    {
        // Eager Loading/
        $jobs = Job::with('employer')->latest()->simplePaginate(3);
        return view('jobs.index', ['jobs' => $jobs]);
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function show(Job $job)
    {
        return view('jobs.show', ['job' => $job]);
    }

    public function store()
    {
        // validate
        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required'],
        ]);

        // create the job
        Job::create([
            'title' => request('title'),
            'salary' => request('salary'),
            'employer_id' => 1,
        ]);

        // return to jobs page
        return redirect('/jobs');
    }

    public function edit(Job $job)
    {

        // Auth
        // if (Auth::guest()) return redirect('/login');
        // if ($job->employer->user->isNot(Auth::user())) abort(403);

        // Setting Gate AppServiceProvider.php
        // Gate::authorize('edit-job', $job);

        // using router middleware

        return view('jobs.edit', ['job' => $job]);
    }

    public function update(Job $job)
    {
        // validate
        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required'],
        ]);

        // authorize

        // update the job
        $job->update([
            'title' => request('title'),
            'salary' => request('salary'),
        ]);

        // redirect to the job page
        return redirect('/jobs/' . $job->id);
    }

    public function destroy(Job $job)
    {
        // authorize

        // delete the job
        $job->delete();

        // redirect
        return redirect('/jobs');
    }
}
