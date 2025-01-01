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
            $period = CarbonPeriod::create($start, "1 month", $end);
            $pendaftarPerbulan = collect($period)->map(function ($date) {
                $endDate = $date->copy()->endOfMonth();
                return [
                    "count" => PendaftarPpdb::where("created_at", "<=", $endDate)->count(),
                    "month" => $endDate->format("Y-m-d")
                ];
            });

            $PendaftarChart = Chartjs::build()
                ->name("UserRegistrationsChart")
                ->type("line")
                ->size(["width" => 400, "height" => 200])
                ->labels($pendaftarPerbulan->pluck("month")->toArray())
                ->datasets([
                    [
                        "label" => "Pendaftar PPDB",
                        "backgroundColor" => "rgba(38, 185, 154, 0.31)",
                        "borderColor" => "rgba(38, 185, 154, 0.7)",
                        "data" => $pendaftarPerbulan->pluck("count")->toArray()
                    ]
                ])
                ->options([
                    'scales' => [
                        'x' => [
                            'type' => 'time',
                            'time' => [
                                'unit' => 'month'
                            ],
                            'min' => $start,
                        ]
                    ],
                    'plugins' => [
                        'title' => [
                            'display' => true,
                            'text' => 'Pendaftar PPDB Per Bulan'
                        ]
                    ]
                ]);
            return view("dashboard.{$role}", compact('pendaftar', 'PendaftarChart'));
        }
        return view('dashboard');
    }
}
