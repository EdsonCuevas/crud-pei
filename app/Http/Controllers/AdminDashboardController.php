<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Expenses;
use Inertia\Inertia;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
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

        return Inertia::render('Admin/Dashboard', [
            'donations' => $donations,
            'expenses' => $expenses,
        ]);
    }
}
