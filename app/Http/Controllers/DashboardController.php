<?php

namespace App\Http\Controllers;

use App\Models\PembayaranPpdb;
use App\Models\PendaftarPpdb;
use App\Models\PeriodePPDB;
use App\Models\User;
use App\Models\WaliPendaftar;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use IcehouseVentures\LaravelChartjs\Facades\Chartjs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public static function isUserVerified()
    {
        $formulir = PendaftarPpdb::where('user_id', Auth::user()->id)
            ->where('verification_status', 'verified')
            ->exists();

        $pembayaran = PembayaranPpdb::where('user_id', Auth::user()->id)
            ->where('verification_status', 'verified')
            ->exists();

        return $formulir && $pembayaran;
    }

    public function dashboard(Request $request)
    {
        $role = Auth::user()->getEffectiveRole();


        if ($role == 'pendaftar') {
            if ($this->isUserVerified()) {
                return redirect()->route('status-pendaftaran.index');
            }
            return redirect()->route('formulir-ppdb.dataPendaftar');
        }

        $periodeAktif = $this->getPeriodeAktif();
        
        $periodeFilter = $this->getPeriodeFilter($request, $role, $periodeAktif);
        
        $periodeList = $this->getPeriodeList($role);

        $pendaftar = $this->getFilteredPendaftar($periodeFilter);
        $pembayaran = $this->getFilteredPembayaran($periodeFilter);

        $accountWithRolePendaftar = $this->getFilteredUsers($periodeFilter);
        $belumMengisiFormulir = $accountWithRolePendaftar->filter(function ($user) use ($pendaftar) {
            $userPendaftar = $pendaftar->firstWhere('user_id', $user->id);
            return $userPendaftar && is_null($userPendaftar->verification_status);
        })->count();

        $charts = [];
        if ($role == 'kepsek') {
            $charts = [
                'PendaftarChart' => $this->createRegistrationTrendChart($periodeFilter),
                'uncompleteRegistrationChart' => $this->createVerificationStatusChart($periodeFilter),
                'genderChart' => $this->createGenderDistributionChart($periodeFilter),
                'previousSchoolChart' => $this->createPreviousSchoolDistributionChart($periodeFilter),
                'averageIncomeChart' => $this->createAverageIncomeChart($periodeFilter),
                'kipChart' => $this->createKipDistributionChart($periodeFilter),
                'domisiliChart' => $this->createDomisiliDistributionChart($periodeFilter),
            ];
        }

        $data = array_merge([
            'periodeList' => $periodeList,
            'selectedPeriode' => $periodeFilter,
            'periodeAktif' => $periodeAktif,
            'pendaftar' => $pendaftar,
            'pembayaran' => $pembayaran,
            'belumMengisiFormulir' => $belumMengisiFormulir,
        ], $charts);

        if (view()->exists("dashboard.{$role}")) {
            return view("dashboard.{$role}", $data);
        }
        
        return view('dashboard', $data);
    }

    private function getPeriodeAktif()
    {
        $today = Carbon::now();
        
        return PeriodePPDB::where('startDate', '<=', $today)
            ->where('endDate', '>=', $today)
            ->first();
    }

    private function getPeriodeFilter($request, $role, $periodeAktif)
    {
        if ($role == 'kepsek') {
            $default = $periodeAktif ? $periodeAktif->id_periode : 'all';
            return $request->get('periode', $default);
        }

        $periodeList = $this->getPeriodeList($role);
        $default = $periodeList->first()->id_periode ?? 'all';
        
        return $request->get('periode', $default);
    }

    private function getPeriodeList($role)
    {
        $userId = Auth::id();

        if ($role == 'kepsek') {
            return PeriodePPDB::orderBy('startDate', 'desc')->get();
        }

        if ($role == 'panitia') {
            return Auth::user()->periodePpdb()->orderBy('startDate', 'desc')->get();
        }

        if ($role == 'bendahara') {
            return PeriodePPDB::whereHas('bendahara', function($query) use ($userId) {
                $query->where('user_id', $userId);
            })->orderBy('startDate', 'desc')->get();
        }

        return PeriodePPDB::orderBy('startDate', 'desc')->get();
    }

    private function getFilteredPendaftar($periodeFilter)
{
    $role = Auth::user()->role;
    $userId = Auth::id();

    $query = PendaftarPpdb::with('user', 'periode', 'dataDiriPendaftar', 'wali');

    if ($periodeFilter !== 'all') {
        $query->where('pendaftar_ppdb.id_periode', $periodeFilter);
    }

    if ($role == 'panitia') {
        $periodeIds = Auth::user()->periodePpdb()->pluck('periode_ppdb.id_periode')->toArray();
        $query->whereIn('pendaftar_ppdb.id_periode', $periodeIds);
    }

    if ($role == 'bendahara') {
        $periodeIds = PeriodePPDB::whereHas('bendahara', function($q) use ($userId) {
            $q->where('user_id', $userId);
        })->pluck('periode_ppdb.id_periode')->toArray();
        $query->whereIn('pendaftar_ppdb.id_periode', $periodeIds);
    }

    return $query->get();
}

private function getFilteredPembayaran($periodeFilter)
{
    $role = Auth::user()->role;
    $userId = Auth::id();

    $query = PembayaranPpdb::with('user');

    if ($periodeFilter !== 'all') {
        $query->where('pembayaran_ppdb.id_periode', $periodeFilter);
    }

    if ($role == 'panitia') {
        $periodeIds = Auth::user()->periodePpdb()->pluck('periode_ppdb.id_periode')->toArray();
        $query->whereIn('pembayaran_ppdb.id_periode', $periodeIds);
    }

    if ($role == 'bendahara') {
        $periodeIds = PeriodePPDB::whereHas('bendahara', function($q) use ($userId) {
            $q->where('user_id', $userId);
        })->pluck('periode_ppdb.id_periode')->toArray();
        $query->whereIn('pembayaran_ppdb.id_periode', $periodeIds);
    }

    return $query->get();
}

    private function getFilteredUsers($periodeFilter)
    {
        $query = User::where('role', 'pendaftar');

        if ($periodeFilter !== 'all') {
            $query->whereHas('pendaftarPpdb', function($q) use ($periodeFilter) {
                $q->where('id_periode', $periodeFilter);
            });
        }

        return $query->get();
    }

    private function getPendaftarPerDay($periodeFilter)
    {
        $query = PendaftarPpdb::query();

        if ($periodeFilter !== 'all') {
            $query->where('id_periode', $periodeFilter);
            
            $periode = PeriodePPDB::find($periodeFilter);
            if ($periode) {
                $start = Carbon::parse($periode->startDate);
                $end = Carbon::parse($periode->endDate);
                
                if ($end->gt(Carbon::now())) {
                    $end = Carbon::now();
                }
            } else {
                $start = Carbon::parse($query->min("created_at") ?? Carbon::now());
                $end = Carbon::now();
            }
        } else {
            $start = Carbon::parse($query->min("created_at") ?? Carbon::now());
            $end = Carbon::now();
        }

        $period = CarbonPeriod::create($start, "1 day", $end);

        return collect($period)->map(function ($date) use ($query) {
            return [
                "count" => (clone $query)->whereDate("created_at", $date->format("Y-m-d"))->count(),
                "date" => $date->format("Y-m-d")
            ];
        });
    }

    private function createRegistrationTrendChart($periodeFilter = 'all')
    {
        $pendaftarPerDay = $this->getPendaftarPerDay($periodeFilter);

        $judul = 'Pendaftar PPDB Per Hari';
        if ($periodeFilter !== 'all') {
            $periode = PeriodePPDB::find($periodeFilter);
            if ($periode) {
                $judul = 'Pendaftar PPDB Per Hari';
            }
        }

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
                        ],
                        'ticks' => [
                            'stepSize' => 1,
                            'precision' => 0
                        ],
                        'beginAtZero'=> true
                    ]
                ],
                'plugins' => [
                    'title' => [
                        'display' => true,
                        'text' => $judul
                    ]
                ]
            ]);
    }

    private function createVerificationStatusChart($periodeFilter = 'all')
    {
        $pendaftar = $this->getFilteredPendaftar($periodeFilter);
        $accountWithRolePendaftar = $this->getFilteredUsers($periodeFilter);

        $usersWithoutPendaftarPpdb = $accountWithRolePendaftar->filter(function ($user) use ($pendaftar) {
        //     return !$pendaftar->contains('user_id', $user->id); 
        // })->count();
         $userPendaftar = $pendaftar->firstWhere('user_id', $user->id);
    return $userPendaftar && is_null($userPendaftar->verification_status);
})->count();

        $statusCount = collect($pendaftar)
            ->groupBy('verification_status')
            ->map(function ($group) {
                return $group->count();  
            })
            ->pipe(function ($counts) use ($usersWithoutPendaftarPpdb) {
                return [
                    'pending' => $counts['pending'] ?? 0,
                    'verified' => $counts['verified'] ?? 0,
                    'rejected' => $counts['rejected'] ?? 0,
                    'tidak_ada_di_pendaftar' => $usersWithoutPendaftarPpdb 
                ];
            });

        $judul = 'Statistik Status Pendaftaran Pendaftar';
        if ($periodeFilter !== 'all') {
            $periode = PeriodePPDB::find($periodeFilter);
            if ($periode) {
                $judul = 'Status Pendaftaran - ' . $periode->name;
            }
        }

        return Chartjs::build()
            ->name("uncompleteRegistrationChart")
            ->type("doughnut") 
            ->size(["width" => 400, "height" => 300])
            ->labels(['Menunggu Di Verifikasi', 'Pendaftaran Selesai', 'Formulir perlu perbaikan', 'Belum mengisi Formulir']) 
            ->datasets([[
                "label" => "Jumlah Pendaftar",
                "backgroundColor" => [
                    "rgba(255, 206, 86, 0.7)",  
                    "rgba(75, 192, 192, 0.7)",  
                    "rgba(255, 99, 132, 0.7)",  
                    "rgba(201, 203, 207, 0.7)"  
                ],
                "borderColor" => [
                    "rgba(255, 206, 86, 1)",
                    "rgba(75, 192, 192, 1)",
                    "rgba(255, 99, 132, 1)",
                    "rgba(201, 203, 207, 1)"
                ],
                "data" => array_values($statusCount)  
            ]])
            ->options([
                'responsive' => true,
                'maintainAspectRatio' => false,
                'plugins' => [
                    'title' => [
                        'display' => true,
                        'text' => $judul,
                        'align' => 'center',
                        'font' => [
                            'size' => 14,
                            'weight' => 'bold'
                        ],
                        'padding' => 20
                    ],
                    'legend' => [
                        'display' => true,
                        'position' => 'bottom',
                        'align' => 'center',
                        'labels' => [
                            'boxWidth' => 15,
                            'padding' => 15,
                            'font' => [
                                'size' => 11
                            ]
                        ]
                    ]
                ]
            ]);
    }

    private function createGenderDistributionChart($periodeFilter = 'all')
{
    $pendaftar = $this->getFilteredPendaftar($periodeFilter);

    $totalPendaftar = $pendaftar->count();

    $genderCount = collect($pendaftar)
        ->filter(function ($item) {
            return !is_null($item->verification_status);
        })
        ->map(function ($item) {
            return $item->dataDiriPendaftar->gender ?? null;
        })
        ->filter()
        ->countBy();

    $laki = $genderCount['Laki-Laki'] ?? 0;
    $perempuan = $genderCount['Perempuan'] ?? 0;

    $belumIsiFormulir = $totalPendaftar - ($laki + $perempuan);

    $judul = 'Distribusi Gender Pendaftar';

    return Chartjs::build()
        ->name("genderChart")
        ->type("doughnut")
        ->size(["width" => 400, "height" => 300])
        ->labels(['Laki-Laki', 'Perempuan', 'Belum Mengisi Formulir'])
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
            "data" => [$laki, $perempuan, $belumIsiFormulir]
        ]])
        ->options([
            'responsive' => true,
            'maintainAspectRatio' => false,
            'plugins' => [
                'title' => [
                    'display' => true,
                    'text' => $judul
                ],
                'legend' => [
                    'position' => 'bottom'
                ]
            ]
        ]);
}

    private function createPreviousSchoolDistributionChart($periodeFilter = 'all')
    {
        $pendaftar = $this->getFilteredPendaftar($periodeFilter);

        $previousSchoolCounts = collect($pendaftar)
            ->pluck('dataDiriPendaftar.previous_school_name')
            ->filter()
            ->countBy()
            ->sortDesc()
            ->take(8); 

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

        $judul = 'Statistik Sekolah Asal Pendaftar';
        if ($periodeFilter !== 'all') {
            $periode = PeriodePPDB::find($periodeFilter);
            if ($periode) {
                $judul = 'Sekolah Asal ' ;
            }
        }

        return Chartjs::build()
            ->name("previousSchoolChart")
            ->type("doughnut")
            ->size(["width" => 400, "height" => 300])
            ->labels($labels)
            ->datasets([[
                "label" => "Jumlah Pendaftar",
                "backgroundColor" => $backgroundColors,
                "borderColor" => "rgba(0, 0, 0, 0.1)",
                "data" => $data
            ]])
            ->options([
                'responsive' => true,
                'maintainAspectRatio' => false,
                'plugins' => [
                    'title' => [
                        'display' => true,
                        'text' => $judul,
                        'align' => 'center',
                        'font' => [
                            'size' => 14,
                            'weight' => 'bold'
                        ],
                        'padding' => 20
                    ],
                    'legend' => [
                        'display' => true,
                        'position' => 'bottom',
                        'align' => 'center',
                        'labels' => [
                            'boxWidth' => 12,
                            'padding' => 10,
                            'font' => [
                                'size' => 10
                            ]
                        ]
                    ]
                ]
            ]);
    }

    private function createAverageIncomeChart($periodeFilter = 'all')
    {
        $pendaftar = $this->getFilteredPendaftar($periodeFilter);

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

        $judul = 'Rata-Rata Pendapatan Ayah dan Ibu';
        if ($periodeFilter !== 'all') {
            $periode = PeriodePPDB::find($periodeFilter);
            if ($periode) {
                $judul = 'Rata-Rata Pendapatan Orang Tua ' ;
            }
        }

        return Chartjs::build()
            ->name("averageIncomeChart")
            ->type("bar")
            ->size(["width" => 400, "height" => 300])
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
                'responsive' => true,
                'maintainAspectRatio' => false,
                'plugins' => [
                    'title' => [
                        'display' => true,
                        'text' => $judul,
                        'align' => 'center',
                        'font' => [
                            'size' => 14,
                            'weight' => 'bold'
                        ],
                        'padding' => 20
                    ],
                    'legend' => [
                        'display' => false
                    ]
                ],
                'scales' => [
                    'y' => [
                        'beginAtZero' => true,
                        'title' => [
                            'display' => true,
                            'text' => 'Rupiah',
                            'font' => [
                                'size' => 11
                            ]
                        ]
                    ]
                ]
            ]);
    }

    private function createKipDistributionChart($periodeFilter = 'all')
    {
        $pendaftar = $this->getFilteredPendaftar($periodeFilter);

         $kipCounts = collect($pendaftar)
        ->pluck('dataDiriPendaftar.kip') 
        ->map(function ($kip) {
            if (is_null($kip)) {
                return 'Belum Mengisi Formulir';
            } elseif ($kip === '-') {
                return 'Tidak Memiliki KIP';
            } else {
                return 'Memiliki KIP';
            }
        })
        ->countBy();

        $labels = $kipCounts->keys()->toArray();
        $data = $kipCounts->values()->toArray();

        $backgroundColors = [
            'rgba(75, 192, 192, 0.7)',
            'rgba(255, 99, 132, 0.7)',
            "rgba(201, 203, 207, 0.7)"
        ];

        $judul = 'Statistik KIP Pendaftar';
        if ($periodeFilter !== 'all') {
            $periode = PeriodePPDB::find($periodeFilter);
            if ($periode) {
                $judul = 'Penerima KIP ';
            }
        }

        return Chartjs::build()
            ->name("kipChart")
            ->type("doughnut")
            ->size(["width" => 400, "height" => 300])
            ->labels($labels)
            ->datasets([[
                "label" => "Jumlah Pendaftar",
                "backgroundColor" => $backgroundColors,
                "borderColor" => "rgba(0, 0, 0, 0.1)",
                "data" => $data
            ]])
            ->options([
                'responsive' => true,
                'maintainAspectRatio' => false,
                'plugins' => [
                    'title' => [
                        'display' => true,
                        'text' => $judul,
                        'align' => 'center',
                        'font' => [
                            'size' => 14,
                            'weight' => 'bold'
                        ],
                        'padding' => 20
                    ],
                    'legend' => [
                        'display' => true,
                        'position' => 'bottom',
                        'align' => 'center',
                        'labels' => [
                            'boxWidth' => 15,
                            'padding' => 15,
                            'font' => [
                                'size' => 11
                            ]
                        ]
                    ]
                ]
            ]);
    }

    private function createDomisiliDistributionChart($periodeFilter = 'all')
    {
        $pendaftar = $this->getFilteredPendaftar($periodeFilter);

        $domisiliCounts = collect($pendaftar)
            ->pluck('dataDiriPendaftar.domisili')
            ->filter()
            ->countBy()
            ->sortDesc()
            ->take(10); 

        $labels = $domisiliCounts->keys()->toArray();
        $data = $domisiliCounts->values()->toArray();

        $backgroundColors = array_map(function ($index) {
            $colors = [
                'rgba(255, 99, 132, 0.7)',
                'rgba(54, 162, 235, 0.7)',
                'rgba(255, 206, 86, 0.7)',
                'rgba(75, 192, 192, 0.7)',
                'rgba(153, 102, 255, 0.7)',
                'rgba(255, 159, 64, 0.7)',
                'rgba(199, 199, 199, 0.7)',
                'rgba(83, 102, 255, 0.7)',
                'rgba(255, 99, 255, 0.7)',
                'rgba(99, 255, 132, 0.7)'
            ];
            return $colors[$index % count($colors)];
        }, array_keys($labels));

        $judul = 'Statistik Domisili Pendaftar (10 Kota Terbanyak)';
        if ($periodeFilter !== 'all') {
            $periode = PeriodePPDB::find($periodeFilter);
            if ($periode) {
                $judul = 'Domisili Pendaftar ' ;
            }
        }

        return Chartjs::build()
            ->name("domisiliChart")
            ->type("bar")
            ->size(["width" => 400, "height" => 300])
            ->labels($labels)
            ->datasets([[
                "label" => "Jumlah Pendaftar",
                "backgroundColor" => $backgroundColors,
                "borderColor" => "rgba(0, 0, 0, 0.1)",
                "data" => $data
            ]])
            ->options([
                'responsive' => true,
                'maintainAspectRatio' => false,
                'plugins' => [
                    'title' => [
                        'display' => true,
                        'text' => $judul,
                        'align' => 'center',
                        'font' => [
                            'size' => 14,
                            'weight' => 'bold'
                        ],
                        'padding' => 20
                    ],
                    'legend' => [
                        'display' => false
                    ]
                ],
                'scales' => [
                    'y' => [
                        'beginAtZero' => true,
                        'title' => [
                            'display' => true,
                            'text' => 'Jumlah Pendaftar',
                            'font' => [
                                'size' => 11
                            ]
                        ],
                        'ticks' => [
                            'stepSize' => 1,
                            'precision' => 0
                        ]
                    ],
                    'x' => [
                        'title' => [
                            'display' => true,
                            'text' => 'Kota Domisili',
                            'font' => [
                                'size' => 11
                            ]
                        ],
                        'ticks' => [
                            'maxRotation' => 45,
                            'minRotation' => 45,
                            'font' => [
                                'size' => 10
                            ]
                        ]
                    ]
                ]
            ]);
    }
}