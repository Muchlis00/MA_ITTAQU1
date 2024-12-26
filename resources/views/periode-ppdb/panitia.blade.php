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
                                    <button type="submit" class="btn btn-danger">Hapus</button>
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
                                    <button type="submit" class="btn btn-danger">Hapus</button>
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
                    <h5 class="modal-title" id="buatPeriodeModalLabel">Tambah Panitia / Bendahar</h5>
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
                            <div class="form-group mb-3 d-flex" style="gap: 1em">
                                <label for="name" class="form-label">Nama</label>
                                <div class="dropdown">
                                <input
                                    type="text"
                                    name="name"
                                    class="form-control"
                                    id="name"
                                    onkeyup=""
                                    autocomplete="off" autofill="off"
                                    required>
                                    <div id="nameDropdown" class="dropdown-menu show" style="display: none;">
                                </div>
                                </div>
                            
                                
                            </div>
                            
                            <div class="form-group mb-3 d-flex" style="gap: 1em">
                                <label for="jabatan" class="form-label">Jabatan</label>
                                <select name="jabatan" id="jabatan" class="form-control" required>
                                    <option value="Panitia">Panitia</option>
                                    <option value="Bendahara">Bendahara</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
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

        // Function to search and display user suggestions
        function searchByName(name) {
            if (name.length < 3) {
                // Hide dropdown if input is too short
                nameDropdown.style.display = "none";
                return;
            }

            fetch(`{{ route('searchUserByName') }}?name=${encodeURIComponent(name)}`)
                .then((response) => response.json())
                .then((data) => {
                    console.log(data)
                    nameDropdown.innerHTML = ""; // Clear previous results
                    if (data.length > 0) {
                        data.forEach((user) => {
                            // Create a dropdown item for each user
                            const item = document.createElement("a");
                            item.classList.add("dropdown-item");
                            item.href = "#";
                            item.textContent = `${user.name} (${user.email})`;
                            item.onclick = function (e) {
                                e.preventDefault();
                                selectUser(user.name, user.jabatan, user.id);
                            };
                            nameDropdown.appendChild(item);
                        });

                        nameDropdown.style.display = "flex"; // Show the dropdown
                        nameDropdown.style.flexDirection = "column";
                        nameDropdown.style.gap = "1em";
                    } else {
                        nameDropdown.style.display = "none"; // Hide dropdown if no users found
                    }
                });
        }

        // Function to select a user from the dropdown
        function selectUser(name, jabatan, id) {
            nameInput.value = name; // Set selected user's name
            jabatanInput.value = jabatan; // Set selected user's jabatan
            nameDropdown.style.display = "none"; // Hide the dropdown
            userId.value = id;

        }

        // Add event listener to name input for keyup
        nameInput.addEventListener("keyup", function () {
            searchByName(nameInput.value);
        });

        // Hide dropdown if clicked outside
        document.addEventListener("click", function (event) {
            if (!nameInput.contains(event.target) && !nameDropdown.contains(event.target)) {
                nameDropdown.style.display = "none";
            }
        });
    });
</script>


    @endsection