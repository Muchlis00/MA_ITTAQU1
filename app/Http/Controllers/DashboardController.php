<?php

namespace App\Http\Controllers;

use App\Models\PendaftarPpdb;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use IcehouseVentures\LaravelChartjs\Facades\Chartjs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function dashboard()
{
    $role = Auth::user()->role;
    if ($role == 'pendaftar') {
        return redirect()->route('formulir-ppdb.dataPendaftar');
    }
    if (view()->exists("dashboard.{$role}")) {
        $pendaftar = PendaftarPpdb::with('user', 'periode')->get();
        
        $start = Carbon::parse(PendaftarPpdb::min("created_at"));
        $end = Carbon::now();
        $period = CarbonPeriod::create($start, "1 day", $end);

        // Aggregate registrants per day
        $pendaftarPerDay = collect($period)->map(function ($date) {
            return [
                "count" => PendaftarPpdb::whereDate("created_at", $date->format("Y-m-d"))->count(),
                "date" => $date->format("Y-m-d")
            ];
        });

        $PendaftarChart = Chartjs::build()
            ->name("UserRegistrationsChart")
            ->type("line")
            ->size(["width" => 600, "height" => 300])
            ->labels($pendaftarPerDay->pluck("date")->toArray())
            ->datasets([
                [
                    "label" => "Pendaftar PPDB",
                    "backgroundColor" => "rgba(38, 185, 154, 0.31)",
                    "borderColor" => "rgba(38, 185, 154, 0.7)",
                    "data" => $pendaftarPerDay->pluck("count")->toArray()
                ]
            ])
            ->options([
                'scales' => [
                    'x' => [
                        'type' => 'time',
                        'time' => [
                            'unit' => 'day'
                        ],
                    ],
                    'y' => [
                        'title' => [
                            'display' => true,
                            'text' => 'Jumlah Pendaftar'
                        ]
                    ]
                ],
                'plugins' => [
                    'title' => [
                        'display' => true,
                        'text' => 'Pendaftar PPDB Per Hari'
                    ]
                ]
            ]);

        return view("dashboard.{$role}", compact('pendaftar', 'PendaftarChart'));
    }
    return view('dashboard');
}

}
