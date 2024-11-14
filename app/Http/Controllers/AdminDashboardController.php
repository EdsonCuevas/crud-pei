<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Expenses;
use App\Models\User;
use Inertia\Inertia;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function index()
    {

        $user = Auth::user();

        if ($user->role->id !== 1) {
            return redirect()->route('401');
        }

        // Obtener donaciones agrupadas por mes
        $donations = Donation::selectRaw('SUM(value) as total, strftime("%m", created_at) as month')
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->map(function ($donation) {
                return [
                    'month' => Carbon::create()->month((int)$donation->month)->format('M'),
                    'total' => $donation->total,
                ];
            });

        // Obtener gastos agrupados por mes
        $expenses = Expenses::selectRaw('SUM(value) as total, strftime("%m", created_at) as month')
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->map(function ($expense) {
                return [
                    'month' => Carbon::create()->month((int)$expense->month)->format('M'),
                    'total' => $expense->total,
                ];
            });

        // Obtener usuarios registrados por mes en el año actual
        $usersPerMonth = User::selectRaw("strftime('%m', created_at) as month_number, strftime('%Y', created_at) as year, strftime('%m', created_at) as month, COUNT(*) as total")
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('month_number')
            ->orderBy('month_number')
            ->get()
            ->map(function ($item) {
                // Convertir el número de mes a nombre de mes (por ejemplo: "01" a "January")
                $item->month = date("F", mktime(0, 0, 0, $item->month, 1));
                return $item;
            });

        return Inertia::render('Admin/Dashboard', [
            'donations' => $donations,
            'expenses' => $expenses,
            'usersPerMonth' => $usersPerMonth,
        ]);
    }
}
