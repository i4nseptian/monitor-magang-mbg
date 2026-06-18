<?php

namespace App\Http\Controllers;

use App\Models\Logbook;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

class WelcomeController extends Controller
{
    public function __invoke()
    {
        $data = Cache::remember('welcome_page_stats', 300, function () {
            $mahasiswaList = User::role('mahasiswa')->with('member')->get();
            return [
                'mahasiswaList' => $mahasiswaList,
                'totalMahasiswa' => $mahasiswaList->count(),
                'totalLogbooksCount' => Logbook::count(),
                'totalProjectsCount' => Project::count(),
            ];
        });

        return view('welcome', $data);
    }
}
