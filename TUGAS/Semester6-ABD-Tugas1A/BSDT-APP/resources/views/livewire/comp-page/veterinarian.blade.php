<div class="col">
    <h5 class="mb-3 fw-bold">
        TABLE VETERINARIAN
    </h5>
    <div class="col mb-2 bg-dark p-2 rounded-1">
        <button type="button" class="btn btn-sm text-white bg-primary mt-0 mb-0 me-4" data-bs-toggle="modal"
            data-bs-target="#tambahVeterinarian" id="buttonAddVeterinarian">
            <i class="fa-solid fa-plus"></i>
            &nbsp;Tambah Veterinarian
        </button>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nama</th>
                <th scope="col">No Telp</th>
                <th scope="col">Tanggal Mulai</th>
                <th scope="col">Status Kontrak</th>
                <th scope="col">Klinik</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @if (!$data->isEmpty())
                @foreach ($data as $d)
                    <tr>
                        <th scope="row">{{ $d->vet_id }}</th>
                        <td>{{ $d->vet_fullname }}</td>
                        <td>{{ $d->vet_num_telp }}</td>
                        <td>{{ $d->vet_start_date }}</td>
                        <td>{{ $d->vet_contract_status }}</td>
                        <td>{{ $d->clinic_id }} - {{ $d->clinic->clinic_name }}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                data-bs-target="#editVeterinarian" id="buttonEditVeterinarian"
                                wire:click='showEditVeterinarian({{ $d->vet_id }})'>
                                <i class="fa-regular fa-pen-to-square"></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#hapusVeterinarian" id="buttonDeleteVeterinarian"
                                wire:click='showHapusVeterinarian({{ $d->vet_id }})'>
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="7" class="text-center fw-bold">Data Kosong</td>
                </tr>
            @endif
        </tbody>
    </table>

    {{-- Modal Tambah Veterinarian --}}
    <div wire:ignore.self class="modal fade" id="tambahVeterinarian" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="tambahVeterinarianLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="tambahVeterinarianLabel">TAMBAH VETERINARIAN</h1>
                    <button type="button" class="btn-close btn-dark bg-dark" data-bs-dismiss="modal" aria-label="Close"
                        wire:click='resetInputs'></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="addVeterinarian" class=''>
                        <div class="form-group col-12">
                            <label for="vet_id">Vet ID</label>
                            <input wire:model='vet_id' type="string" class="form-control border-2 p-2"
                                id="vet_id" placeholder="" autocomplete="off">
                            @error('vet_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="vet_fullname">Nama</label>
                            <input wire:model='vet_fullname' type="string" class="form-control border-2 p-2"
                                id="vet_fullname" placeholder="" autocomplete="off">
                            @error('vet_fullname')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="vet_num_telp">No Telp</label>
                            <input wire:model='vet_num_telp' type="string" class="form-control border-2 p-2"
                                id="vet_num_telp" placeholder="" autocomplete="off">
                            @error('vet_num_telp')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="vet_start_date">Tanggal Mulai</label>
                            <input wire:model='vet_start_date' type="date" class="form-control border-2 p-2"
                                id="vet_start_date" placeholder="" autocomplete="off">
                            @error('vet_start_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="vet_contract_status">Status Kontrak</label>
                            <select class="form-select border-2 p-2"
                                aria-label="Default select example"
                                wire:model.live="vet_contract_status"
                                id="vet_contract_status">
                                <option value="">-- Pilih Status --</option>
                                <option value="Aktif">Aktif</option>
                                <option value="Tidak Aktif">Tidak Aktif</option>
                            </select>
                            @error('vet_contract_status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="clinic_id">Klinik</label>
                            <select class="form-select border-2 p-2"
                                aria-label="Default select example"
                                wire:model.live="clinic_id"
                                id="clinic_id">
                                @if ($clinic->isEmpty())
                                    <option value="">Data Klinik Kosong</option>
                                @else
                                    <option value="">-- Pilih Klinik --</option>
                                    @foreach ($clinic as $cl)
                                        <option value="{{ $cl->clinic_id }}">
                                            {{ $cl->clinic_id }} - {{ $cl->clinic_name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @error('clinic_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col">
                            <div class="col mt-3">
                                <button type="submit" class="btn btn-dark btn-sm" data-bs-dismiss="modal"
                                    data-bs-target="#tambahVeterinarian">
                                    <i class="fa-solid fa-plus"></i>
                                    &nbsp;Tambah Veterinarian
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm my-1 btn-secondary" data-bs-dismiss="modal"
                        data-bs-target="#tambahVeterinarian" wire:click="resetInputs">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Edit Veterinarian --}}
    <div wire:ignore.self class="modal fade" id="editVeterinarian" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="editVeterinarianLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editVeterinarianLabel">EDIT Veterinarian</h1>
                    <button type="button" class="btn-close btn-dark bg-dark" data-bs-dismiss="modal"
                        aria-label="Close" wire:click='resetInputs'></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="editVeterinarian" class=''>

                        <div class="form-group col-12">
                            <label for="vet_id">Vet ID</label>
                            <input wire:model='vet_id' type="string" class="form-control border-2 p-2"
                                id="vet_id" placeholder="" autocomplete="off" disabled>
                            @error('vet_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="vet_fullname">Nama</label>
                            <input wire:model='vet_fullname' type="string" class="form-control border-2 p-2"
                                id="vet_fullname" placeholder="" autocomplete="off">
                            @error('vet_fullname')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="vet_num_telp">No Telp</label>
                            <input wire:model='vet_num_telp' type="string" class="form-control border-2 p-2"
                                id="vet_num_telp" placeholder="" autocomplete="off">
                            @error('vet_num_telp')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="vet_start_date">Tanggal Mulai</label>
                            <input wire:model='vet_start_date' type="date" class="form-control border-2 p-2"
                                id="vet_start_date" placeholder="" autocomplete="off">
                            @error('vet_start_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="vet_contract_status">Status Kontrak</label>
                            <select class="form-select border-2 p-2"
                                aria-label="Default select example"
                                wire:model.live="vet_contract_status"
                                id="vet_contract_status">
                                <option value="">-- Pilih Status --</option>
                                <option value="Aktif">Aktif</option>
                                <option value="Tidak Aktif">Tidak Aktif</option>
                            </select>
                            @error('vet_contract_status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="clinic_id">Klinik</label>
                            <select class="form-select border-2 p-2"
                                aria-label="Default select example"
                                wire:model.live="clinic_id"
                                id="clinic_id">
                                @if ($clinic->isEmpty())
                                    <option value="">Data Klinik Kosong</option>
                                @else
                                    <option value="">-- Pilih Klinik --</option>
                                    @foreach ($clinic as $cl)
                                        <option value="{{ $cl->clinic_id }}">
                                            {{ $cl->clinic_id }} - {{ $cl->clinic_name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @error('clinic_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col">
                            <div class="col mt-3">
                                <button type="submit" class="btn btn-warning btn-sm" data-bs-dismiss="modal"
                                    data-bs-target="#editVeterinarian">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                    Edit Veterinarian
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm my-1 btn-secondary" data-bs-dismiss="modal"
                        data-bs-target="#editVeterinarian" wire:click="resetInputs">Cancel</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Hapus Pengeluaran -->
    <div wire:ignore.self class="modal fade" id="hapusVeterinarian" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="hapusVeterinarianLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="col-12 text-center">
                        <span class="text-danger display-5" style="font-size: 120px">
                            <i class="fa-solid fa-circle-exclamation"></i>
                        </span>

                        <br />

                        <p class="text-sm">
                            Yakin Ingin Menghapus Vet<br />
                            <span class="fw-bold">
                                {{ $vet_id }} - {{ $vet_fullname }}
                            </span>
                        </p>
                    </div>

                    <form wire:submit.prevent="deleteVeterinarian">
                        <div class="col">
                            <div class="col mt-3 text-center">
                                <button type="submit" class="btn btn-danger btn-sm" data-bs-dismiss="modal"
                                    data-bs-target="#hapusVeterinarian">
                                    <i style="font-size: 15px" class="fas fa-trash" aria-hidden="true"></i>
                                    HAPUS
                                </button>

                                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal"
                                    data-bs-target="#hapusVeterinarian" aria-label="Close" wire:click="resetInputs">
                                    <i style="font-size: 15px" class="fas fa-xmark"></i>
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
