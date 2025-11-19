<?php

namespace App\Http\Middleware;

use App\Models\SkillReview;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckSkillCompetency
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        $employeeId = Auth::user()->id;

        // Check if the skill competency has been submitted
        $hasSubmitted = SkillReview::where('user_id', $employeeId)->exists();

        if (!$hasSubmitted) {
            // Redirect to the dashboard with an error message
            return redirect('/dashboard')->with('error', 'Skill competency has not been submitted.');
        }

        return $next($request);
    }
}
