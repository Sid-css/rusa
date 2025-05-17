<?php
// app/Http/Controllers/DashboardController.php
namespace App\Http\Controllers;

use App\Models\Scheme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user  = Auth::user();
        $query = $request->input('search');

        $schemesQuery = Scheme::with(['institution','schemeDetail','projects']);

        if (! $user->isAdmin()) {
            $schemesQuery->where('institution_id', $user->institution_id);
        }

        if ($query) {
            $schemesQuery->where(function($q) use ($query) {
                $q->whereHas('schemeDetail', fn($q2) => 
                        $q2->where('name','like',"%{$query}%"))
                  ->orWhereHas('projects', fn($q2) => 
                        $q2->where('name','like',"%{$query}%"))
                  ->orWhereHas('institution', fn($q2) => 
                        $q2->where('name','like',"%{$query}%"));
            });
        }

        $schemes = $schemesQuery->paginate(12)->withQueryString();

        return view('dashboard', compact('schemes','query'));
    }
}
