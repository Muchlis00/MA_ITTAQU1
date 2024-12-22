@extends('layouts.navbar')
@section('content')
<div class="container-fluid">
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
