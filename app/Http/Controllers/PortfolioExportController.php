<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\Project;
use App\Models\SkillDevelopment;
use App\Models\Target;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PortfolioExportController extends Controller
{
    public function __invoke(Request $request, ?int $userId = null)
    {
        $authUser = Auth::user();
        $targetId = $userId ?? $authUser->id;

        $user = User::with('member')->find($targetId);
        if (!$user) {
            abort(404, 'User tidak ditemukan.');
        }

        $skills = SkillDevelopment::where('user_id', $targetId)->get();
        $projects = Project::where('user_id', $targetId)->get();
        $achievements = Achievement::where('user_id', $targetId)->orderBy('tanggal', 'desc')->get();
        $targets = Target::where('user_id', $targetId)->get();

        $data = [
            'user' => $user,
            'member' => $user->member,
            'skills' => $skills,
            'projects' => $projects,
            'achievements' => $achievements,
            'targets' => $targets,
        ];

        $pdf = Pdf::loadView('exports.portfolio-pdf', $data)->setPaper('a4');

        return $pdf->download('portfolio-' . $user->name . '.pdf');
    }
}
