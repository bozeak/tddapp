<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectInvitationsRequest;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectInvitationsController extends Controller
{
    public function store(Project $project, ProjectInvitationsRequest $request)
    {
        $user = User::whereEmail($request->get('email'))->first();

        $project->invite($user);

        return redirect($project->path());
    }
}
