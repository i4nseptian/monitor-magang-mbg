<?php

namespace App\Filament\Pages;

use App\Models\Achievement;
use App\Models\Member;
use App\Models\Project;
use App\Models\SkillDevelopment;
use App\Models\Target;
use App\Models\User;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class Portfolio extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static string $view = 'filament.pages.portfolio';

    protected static ?string $navigationLabel = 'Portfolio Saya';

    protected static ?string $title = 'Portfolio Magang';

    protected static ?string $navigationGroup = 'Portfolio';

    protected static ?int $navigationSort = 2;

    public array $portfolioData = [];

    public function mount(): void
    {
        $userId = Auth::user()->isMahasiswa() ? Auth::id() : null;

        if (!$userId) {
            $userId = Auth::id();
        }

        $user = User::with('member')->find($userId);
        $skills = SkillDevelopment::where('user_id', $userId)->get();
        $projects = Project::where('user_id', $userId)->get();
        $achievements = Achievement::where('user_id', $userId)->orderBy('tanggal', 'desc')->get();
        $targets = Target::where('user_id', $userId)->get();

        $this->portfolioData = [
            'user' => $user,
            'member' => $user?->member,
            'skills' => $skills,
            'projects' => $projects,
            'achievements' => $achievements,
            'targets' => $targets,
        ];
    }
}
