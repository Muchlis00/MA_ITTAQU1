<div class="container">
<div class="modal fade" id="editPeriodeModal{{ $ppdb->id_periode }}" tabindex="-1" role="dialog" aria-labelledby="editPeriodeModal{{ $ppdb->id_periode }}" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Periode</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form action="{{ route('periode-ppdb.update', ['periode_ppdb' => $ppdb->id_periode]) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="name{{ $ppdb->id_periode }}" class="form-label">Nama</label>
                                <input type="text" name="name" class="form-control" id="name{{ $ppdb->id_periode }}" value="{{ $ppdb->name }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="startDate{{ $ppdb->id_periode }}" class="form-label">Tanggal Mulai</label>
                                <input type="date" name="startDate" class="form-control" id="startDate{{ $ppdb->id_periode }}" value="{{ $ppdb->startDate }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="endDate{{ $ppdb->id_periode }}" class="form-label">Tanggal Berakhir</label>
                                <input type="date" name="endDate" class="form-control" id="endDate{{ $ppdb->id_periode }}" value="{{ $ppdb->endDate }}" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>