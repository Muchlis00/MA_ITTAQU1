<?php

namespace App\Http\Controllers;

use App\Models\PendaftarPpdb;
use App\Models\User;
use App\Models\WaliPendaftar;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use IcehouseVentures\LaravelChartjs\Facades\Chartjs;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $role = Auth::user()->role;

        if ($role == 'pendaftar') {
            return redirect()->route('formulir-ppdb.dataPendaftar');
        }

        if (!view()->exists("dashboard.{$role}")) {
            return view('dashboard');
        }

        $pendaftar = PendaftarPpdb::with('user', 'periode', 'dataDiriPendaftar', 'wali')->get();
        $accountWithRolePendaftar = User::where('role', 'pendaftar')->get();
        $waliPendaftar = WaliPendaftar::with('pendaftar')->get();


        $charts = [
            'PendaftarChart' => $this->createRegistrationTrendChart(),
            'uncompleteRegistrationChart' => $this->createVerificationStatusChart($pendaftar, $accountWithRolePendaftar),
            'genderChart' => $this->createGenderDistributionChart($pendaftar, $accountWithRolePendaftar),
            'previousSchoolChart' => $this->createPreviousSchoolDistributionChart($pendaftar),
            'averageIncomeChart' => $this->createAverageIncomeChart($pendaftar),
            'kipChart' => $this->createKipDistributionChart($pendaftar),
        ];

        return view("dashboard.{$role}", array_merge(['pendaftar' => $pendaftar], $charts));
    }

    private function getPendaftarPerDay()
    {
        $start = Carbon::parse(PendaftarPpdb::min("created_at"));
        $end = Carbon::now();
        $period = CarbonPeriod::create($start, "1 day", $end);

        return collect($period)->map(function ($date) {
            return [
                "count" => PendaftarPpdb::whereDate("created_at", $date->format("Y-m-d"))->count(),
                "date" => $date->format("Y-m-d")
            ];
        });
    }

    private function createRegistrationTrendChart()
    {
        $pendaftarPerDay = $this->getPendaftarPerDay();

        return Chartjs::build()
            ->name("UserRegistrationsChart")
            ->type("line")
            ->size(["width" => 600, "height" => 300])
            ->labels($pendaftarPerDay->pluck("date")->toArray())
            ->datasets([[
                "label" => "Pendaftar PPDB",
                "backgroundColor" => "rgba(38, 185, 154, 0.31)",
                "borderColor" => "rgba(38, 185, 154, 0.7)",
                "data" => $pendaftarPerDay->pluck("count")->toArray()
            ]])
            ->options([
                'scales' => [
                    'x' => [
                        'type' => 'time',
                        'time' => ['unit' => 'day']
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
    }

    private function createVerificationStatusChart($pendaftar, $accountWithRolePendaftar)
    {
        $usersWithoutPendaftarPpdb = $accountWithRolePendaftar->filter(function ($user) use ($pendaftar) {
            return !$pendaftar->contains('user_id', $user->id);
        })->count();
        $statusCount = collect($pendaftar)
            ->groupBy('verification_status')
            ->map(function ($group) {
                return $group->count();
            })
            ->pipe(function ($counts) use ($usersWithoutPendaftarPpdb) {
                return [
                    'pending' => ($counts['pending'] ?? 0) + $usersWithoutPendaftarPpdb,
                    'verified' => $counts['verified'] ?? 0,
                    'rejected' => $counts['rejected'] ?? 0
                ];
            });

        return Chartjs::build()
            ->name("uncompleteRegistrationChart")
            ->type("doughnut")
            ->size(["width" => 200, "height" => 200])
            ->labels(['Hanya Daftar Akun', 'Pendaftaran Selesai', 'Formulir perlu perbaikan'])
            ->datasets([[
                "label" => "Jumlah Pendaftar",
                "backgroundColor" => [
                    "rgba(255, 206, 86, 0.7)",
                    "rgba(75, 192, 192, 0.7)",
                    "rgba(255, 99, 132, 0.7)",
                ],
                "borderColor" => [
                    "rgba(255, 206, 86, 1)",
                    "rgba(75, 192, 192, 1)",
                    "rgba(255, 99, 132, 1)",
                ],
                "data" => array_values($statusCount)
            ]])
            ->options([
                'plugins' => [
                    'title' => [
                        'display' => true,
                        'text' => 'Statistik hanya daftar akun dan yang melakukan pendaftaran PPDB'
                    ]
                ]
            ]);
    }

    private function createGenderDistributionChart($pendaftar, $accountWithRolePendaftar)
    {
        $usersWithoutPendaftarPpdb = $accountWithRolePendaftar->filter(function ($user) use ($pendaftar) {
            return !$pendaftar->contains('user_id', $user->id);
        })->count();
        $genderCount = collect($pendaftar)
            ->map(function ($item) {
                return $item["dataDiriPendaftar"]->gender ?? 'Belum di isi';
            })
            ->groupBy(fn($gender) => $gender)
            ->map(function ($group) {
                return $group->count();
            })
            ->pipe(function ($counts) use ($usersWithoutPendaftarPpdb) {
                return [
                    'Laki-Laki' => $counts['Laki-Laki'] ?? 0,
                    'Perempuan' => $counts['Perempuan'] ?? 0,
                    'Belum di isi' => ($counts['Belum di isi'] ?? 0) + $usersWithoutPendaftarPpdb
                ];
            });

        return Chartjs::build()
            ->name("genderChart")
            ->type("doughnut")
            ->size(["width" => 200, "height" => 200])
            ->labels(['Laki-Laki', 'Perempuan', 'Belum di isi'])
            ->datasets([[
                "label" => "Jumlah Pendaftar",
                "backgroundColor" => [
                    "rgba(54, 162, 235, 0.7)",
                    "rgba(255, 99, 132, 0.7)",
                    "rgba(201, 203, 207, 0.7)"
                ],
                "borderColor" => [
                    "rgba(54, 162, 235, 1)",
                    "rgba(255, 99, 132, 1)",
                    "rgba(201, 203, 207, 1)"
                ],
                "data" => array_values($genderCount)
            ]])
            ->options([
                'plugins' => [
                    'title' => [
                        'display' => true,
                        'text' => 'Statistik Gender Pendaftar PPDB'
                    ]
                ]
            ]);
    }

    private function createPreviousSchoolDistributionChart($pendaftar)
    {
        $previousSchoolCounts = collect($pendaftar)
            ->pluck('dataDiriPendaftar.previous_school_name')
            ->filter()
            ->countBy()
            ->sortDesc();

        $labels = $previousSchoolCounts->keys()->toArray();
        $data = $previousSchoolCounts->values()->toArray();

        $backgroundColors = array_map(function () {
            return sprintf(
                'rgba(%d, %d, %d, 0.7)',
                random_int(0, 255),
                random_int(0, 255),
                random_int(0, 255)
            );
        }, $labels);

        return Chartjs::build()
            ->name("previousSchoolChart")
            ->type("doughnut")
            ->size(["width" => 400, "height" => 200])
            ->labels($labels)
            ->datasets([[ 
                "label" => "Jumlah Pendaftar",
                "backgroundColor" => $backgroundColors, 
                "borderColor" => "rgba(0, 0, 0, 0.1)",
                "data" => $data
            ]])
            ->options([
                'plugins' => [
                    'title' => [
                        'display' => true,
                        'text' => 'Statistik Sekolah Asal Pendaftar'
                    ]
                ],
            ]);
    }

    private function createAverageIncomeChart($pendaftar)
    {
        $fathersIncome = collect();
        $mothersIncome = collect();

        foreach ($pendaftar as $p) {
            foreach ($p->wali as $wali) {
                if ($wali->gender === 'Laki-Laki' && $wali->pendapatan) {
                    $fathersIncome->push((float) $wali->pendapatan);
                } elseif ($wali->gender === 'Perempuan' && $wali->pendapatan) {
                    $mothersIncome->push((float) $wali->pendapatan);
                }
            }
        }

        $averageFatherIncome = $fathersIncome->isNotEmpty() ? $fathersIncome->avg() : 0;
        $averageMotherIncome = $mothersIncome->isNotEmpty() ? $mothersIncome->avg() : 0;

        $labels = ['Ayah', 'Ibu'];
        $data = [$averageFatherIncome, $averageMotherIncome];

        return Chartjs::build()
            ->name("averageIncomeChart")
            ->type("bar")
            ->size(["width" => 400, "height" => 200])
            ->labels($labels)
            ->datasets([[
                "label" => "Rata-Rata Pendapatan",
                "backgroundColor" => [
                    "rgba(54, 162, 235, 0.7)",
                    "rgba(255, 99, 132, 0.7)"
                ],
                "borderColor" => [
                    "rgba(54, 162, 235, 1)",
                    "rgba(255, 99, 132, 1)"
                ],
                "data" => $data
            ]])
            ->options([
                'plugins' => [
                    'title' => [
                        'display' => true,
                        'text' => 'Rata-Rata Pendapatan Ayah dan Ibu'
                    ]
                ],
                'scales' => [
                    'y' => [
                        'beginAtZero' => true
                    ]
                ]
            ]);
    }

    private function createKipDistributionChart($pendaftar)
    {
       
        $kipCounts = collect($pendaftar)
            ->pluck('dataDiriPendaftar.kip')
            ->map(function ($kip) {
                return $kip ? 'Memiliki KIP' : 'Tidak Memiliki KIP'; 
            })
            ->countBy();
      
        $labels = $kipCounts->keys()->toArray();
        $data = $kipCounts->values()->toArray();

        $backgroundColors = [
            'rgba(75, 192, 192, 0.7)',
            'rgba(255, 99, 132, 0.7)' 
        ];

        return Chartjs::build()
            ->name("kipChart")
            ->type("doughnut")
            ->size(["width" => 400, "height" => 200])
            ->labels($labels)
            ->datasets([[
                "label" => "Jumlah Pendaftar",
                "backgroundColor" => $backgroundColors, 
                "borderColor" => "rgba(0, 0, 0, 0.1)",
                "data" => $data
            ]])
            ->options([
                'plugins' => [
                    'title' => [
                        'display' => true,
                        'text' => 'Statistik KIP Pendaftar'
                    ]
                ],
            ]);
    }
}
