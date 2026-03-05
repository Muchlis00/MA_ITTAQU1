@extends('layouts.navbar')
@section('content')
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Panitia PPDB {{$periode->name}} ( {{date('d F Y', strtotime($periode->startDate))}} - {{date('d F Y', strtotime($periode->endDate))}} )</h1>
    </div>
    <div class="card shadow">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($periode->bendahara as $bendahara)
                        <tr>
                            <td>{{$bendahara->name}}</td>
                            <td>Bendahara</td>
                            <td>
                            <form action="{{ route('bendahara-ppdb.destroy', $bendahara->pivot->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="id_periode" value="{{$periode->id_periode}}"/>
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus bendahara ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    @foreach ($periode->panitia as $panitia)
                        <tr>
                            <td>{{$panitia->name}}</td>
                            <td>Panitia</td>
                            <td>
                            <form action="{{ route('panitia-ppdb.destroy', $panitia->pivot->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="id_periode" value="{{$periode->id_periode}}"/>
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus panitia ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="3">
                            <button data-toggle="modal" data-target="#tambahPanitiaModal" class="btn btn-primary d-flex mx-auto">
                                Tambah Panitia / Bendahara
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="tambahPanitiaModal" tabindex="-1" role="dialog" aria-labelledby="tambahPanitiaModal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="buatPeriodeModalLabel">Tambah Panitia / Bendahara</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form action="{{ route('penentuan-panitia-bendahara.store') }}" method="POST">
                            @csrf
                            <input id="user_id" type="hidden" name="user_id" value="">
                            <input type="hidden" name="periode_id" value="{{$periode->id_periode}}">
                            
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Nama Guru</label>
                                <div class="dropdown">
                                    <input
                                        type="text"
                                        name="name"
                                        class="form-control"
                                        id="name"
                                        autocomplete="off" 
                                        placeholder="Ketik minimal 3 huruf untuk mencari guru..."
                                        required>
                                    <div id="nameDropdown" class="dropdown-menu" style="display: none; width: 100%;">
                                    </div>
                                </div>
                                <small class="form-text text-muted">
                                    Hanya guru yang belum menjadi panitia/bendahara di periode ini yang akan muncul
                                </small>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="jabatan" class="form-label">Jabatan</label>
                                <select name="jabatan" id="jabatan" class="form-control" required>
                                    <option value="">-- Pilih Jabatan --</option>
                                    <option value="Panitia">Panitia</option>
                                    <option value="Bendahara">Bendahara</option>
                                </select>
                            </div>
                            
                            <div class="d-flex justify-content-end" style="gap: 10px;">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary" id="submitBtn" disabled>Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const modal = document.getElementById("tambahPanitiaModal");
        const nameInput = document.getElementById("name");
        const nameDropdown = document.getElementById("nameDropdown");
        const jabatanInput = document.getElementById("jabatan");
        const userId = document.getElementById("user_id");
        const submitBtn = document.getElementById("submitBtn");
        const periodeId = "{{$periode->id_periode}}"; 

        function searchByName(name) {
            if (name.length < 3) {
                nameDropdown.style.display = "none";
                nameDropdown.innerHTML = "";
                submitBtn.disabled = true; 
                return;
            }

            fetch(`{{ route('searchGuruByName') }}?name=${encodeURIComponent(name)}&periode_id=${periodeId}`)
                .then((response) => response.json())
                .then((data) => {
                    console.log('Hasil pencarian:', data);
                    nameDropdown.innerHTML = ""; 
                    
                    if (data.length > 0) {
                        data.forEach((user) => {
                            const item = document.createElement("a");
                            item.classList.add("dropdown-item");
                            item.href = "#";
                            item.textContent = `${user.name} (${user.email})`;
                            item.style.cursor = "pointer";
                            item.style.padding = "10px";
                            
                            item.onclick = function (e) {
                                e.preventDefault();
                                selectUser(user.name, user.id);
                            };
                            
                            nameDropdown.appendChild(item);
                        });

                        nameDropdown.style.display = "block";
                    } else {
                        const noResult = document.createElement("div");
                        noResult.classList.add("dropdown-item", "text-muted");
                        noResult.textContent = "Tidak ada guru yang tersedia (sudah menjadi panitia/bendahara)";
                        noResult.style.cursor = "default";
                        nameDropdown.appendChild(noResult);
                        nameDropdown.style.display = "block";
                    }
                })
                .catch((error) => {
                    console.error('Error:', error);
                    nameDropdown.innerHTML = "";
                    const errorItem = document.createElement("div");
                    errorItem.classList.add("dropdown-item", "text-danger");
                    errorItem.textContent = "Terjadi kesalahan saat mencari data";
                    nameDropdown.appendChild(errorItem);
                    nameDropdown.style.display = "block";
                });
        }

        function selectUser(name, id) {
            nameInput.value = name;
            nameDropdown.style.display = "none";
            userId.value = id;
            submitBtn.disabled = false; 
            
            console.log('User dipilih:', { name, id });
        }

        nameInput.addEventListener("keyup", function () {
            userId.value = ""; 
            submitBtn.disabled = true;
            searchByName(nameInput.value);
        });

        $('#tambahPanitiaModal').on('show.bs.modal', function () {
            nameInput.value = "";
            jabatanInput.value = "";
            userId.value = "";
            nameDropdown.style.display = "none";
            nameDropdown.innerHTML = "";
            submitBtn.disabled = true;
        });

        document.addEventListener("click", function (event) {
            if (!nameInput.contains(event.target) && !nameDropdown.contains(event.target)) {
                nameDropdown.style.display = "none";
            }
        });

        document.querySelector('form').addEventListener('submit', function(e) {
            if (!userId.value) {
                e.preventDefault();
                alert('Silakan pilih guru dari dropdown terlebih dahulu!');
                return false;
            }
            
            if (!jabatanInput.value) {
                e.preventDefault();
                alert('Silakan pilih jabatan!');
                return false;
            }
        });
    });
    </script>

@endsection