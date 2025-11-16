@extends('layouts.navbar')
@section('content')
<div class="container-fluid">
@if (session('error'))
    <div class="alert alert-danger" role="alert">
      {{ session('error') }}
    </div>
  @endif
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Periode PPDB</h6>
            <a data-toggle="modal" data-target="#buatPeriodeModal" class="btn btn-primary">Buat Periode</a>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            @foreach ($keys as $key)
                            <th>{{ $key }}</th>
                            @endforeach
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($periodePPDB as $ppdb)
                        <tr>
                            <td>{{ $ppdb->id_periode }}</td>
                            <td>{{ $ppdb->name }}</td>
                            <td>{{ date('d F Y', strtotime($ppdb->startDate)) }}</td>
                            <td>{{ date('d F Y', strtotime($ppdb->endDate)) }}</td>
                            <td>
                                <a data-toggle="modal" data-target="#editPeriodeModal{{ $ppdb->id_periode }}" class="btn btn-primary">Edit</a>
                                <form action="{{ route('periode-ppdb.destroy', $ppdb->id_periode) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                                <a href="{{ route('periode-ppdb.show', $ppdb->id_periode) }}" class="btn btn-warning">Panitia & Bendahara</a>
                                <a href="{{ route('periode-ppdb.exportPdf', $ppdb->id_periode) }}" class="btn btn-primary">Export PDF</a>

                            </td>
                            <td>
                                @php
                        $now = \Carbon\Carbon::now();
                        $start = \Carbon\Carbon::parse($ppdb->startDate);
                        $end = \Carbon\Carbon::parse($ppdb->endDate);
                    @endphp

                   @if ($now->lt($start))
    <i class="fas fa-file-contract text-primary me-2"> Belum Aktif</i>
@elseif ($now->between($start, $end))
  
    <i class="fas fa-check-circle text-success me-1"> Aktif</i> 
</span>
@else

    <i class="fas fa-exclamation-circle text-danger fs-4 me-3 mt-1"> Expired</i>
@endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('periode-ppdb.create')

    @foreach($periodePPDB as $ppdb)
    @include('periode-ppdb.edit')
    @endforeach

</div>
@endsection
