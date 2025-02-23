<div class="col">
    <h5 class="mb-3 fw-bold">
        TABLE CLINIC
    </h5>
    <div class="col mb-2 bg-dark p-2 rounded-1">
        {{-- <button type="button" class="btn btn-primary btn-sm">
            Tambah Data
        </button> --}}
        <button type="button" class="btn btn-sm text-white bg-primary mt-0 mb-0 me-4" data-bs-toggle="modal"
            data-bs-target="#tambahClinic" id="buttonAddClinic">
            <i class="fa-solid fa-plus"></i>
            &nbsp;Tambah Clinic
        </button>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nama Klinik</th>
                <th scope="col">Alamat</th>
                <th scope="col">Nomor Telepon</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @if (!$data->isEmpty())
                @foreach ($data as $d)
                    <tr>
                        <th scope="row">{{ $d->clinic_id }}</th>
                        <td>{{ $d->clinic_name }}</td>
                        <td>{{ $d->clinic_address }}</td>
                        <td>{{ $d->clinic_num_telp }}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                data-bs-target="#editClinic" id="buttonEditClinic"
                                wire:click='showEditClinic({{ $d->clinic_id }})'>
                                <i class="fa-regular fa-pen-to-square"></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#hapusClinic" id="buttonDeleteClinic"
                                wire:click='showHapusClinic({{ $d->clinic_id }})'>
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="5" class="text-center fw-bold">Data Kosong</td>
                </tr>
            @endif
        </tbody>
    </table>


    {{-- Modal Tambah Clinic --}}
    <div wire:ignore.self class="modal fade" id="tambahClinic" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="tambahClinicLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="tambahClinicLabel">TAMBAH CLINIC</h1>
                    <button type="button" class="btn-close btn-dark bg-dark" data-bs-dismiss="modal" aria-label="Close"
                        wire:click='resetInputs'></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="addClinic" class=''>

                        <div class="form-group col-12">
                            <label for="id_klinik">Id Klinik</label>
                            <input wire:model='id_klinik' type="string" class="form-control border-2 p-2"
                                id="id_klinik" placeholder="" autocomplete="off">
                            @error('id_klinik')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="nama_klinik">Nama Klinik</label>
                            <input wire:model='nama_klinik' type="string" class="form-control border-2 p-2"
                                id="nama_klinik" placeholder="" autocomplete="off">
                            @error('nama_klinik')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="alamat_klinik">Alamat Klinik</label>
                            <input wire:model='alamat_klinik' type="string" class="form-control border-2 p-2"
                                id="alamat_klinik" placeholder="" autocomplete="off">
                            @error('alamat_klinik')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="nomor_telepon_klinik">Nomor Telepon Klinik</label>
                            <input wire:model='nomor_telepon_klinik' type="number" class="form-control border-2 p-2"
                                id="nomor_telepon_klinik" placeholder="" autocomplete="off">
                            @error('nomor_telepon_klinik')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col">
                            <div class="col mt-3">
                                <button type="submit" class="btn btn-dark btn-sm" data-bs-dismiss="modal"
                                    data-bs-target="#tambahClinic">
                                    <i class="fa-solid fa-plus"></i>
                                    &nbsp;Tambah Clinic
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm my-1 btn-secondary" data-bs-dismiss="modal"
                        data-bs-target="#tambahClinic" wire:click="resetInputs">Cancel</button>
                    {{-- <button type="button" class="btn btn-sm my-1 btn-secondary" data-bs-dismiss="modal"
                        data-bs-target="#tambahPengeluaran" >Cancel</button> --}}
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Edit Clinic --}}
    <div wire:ignore.self class="modal fade" id="editClinic" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="editClinicLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editClinicLabel">EDIT CLINIC</h1>
                    <button type="button" class="btn-close btn-dark bg-dark" data-bs-dismiss="modal"
                        aria-label="Close" wire:click='resetInputs'></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="editClinic" class=''>

                        <div class="form-group col-12">
                            <label for="id_klinik">Id Klinik</label>
                            <input wire:model='id_klinik' type="string" class="form-control border-2 p-2"
                                id="id_klinik" placeholder="" autocomplete="off" disabled>
                            @error('id_klinik')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="nama_klinik">Nama Klinik</label>
                            <input wire:model='nama_klinik' type="string" class="form-control border-2 p-2"
                                id="nama_klinik" placeholder="" autocomplete="off">
                            @error('nama_klinik')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="alamat_klinik">Alamat Klinik</label>
                            <input wire:model='alamat_klinik' type="string" class="form-control border-2 p-2"
                                id="alamat_klinik" placeholder="" autocomplete="off">
                            @error('alamat_klinik')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="nomor_telepon_klinik">Nomor Telepon Klinik</label>
                            <input wire:model='nomor_telepon_klinik' type="string" class="form-control border-2 p-2"
                                id="nomor_telepon_klinik" placeholder="" autocomplete="off">
                            @error('nomor_telepon_klinik')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col">
                            <div class="col mt-3">
                                <button type="submit" class="btn btn-warning btn-sm" data-bs-dismiss="modal"
                                    data-bs-target="#editClinic">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                    Edit Clinic
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm my-1 btn-secondary" data-bs-dismiss="modal"
                        data-bs-target="#editClinic" wire:click="resetInputs">Cancel</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Hapus Pengeluaran -->
    <div wire:ignore.self class="modal fade" id="hapusClinic" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="hapusClinicLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="col-12 text-center">
                        <span class="text-danger display-5" style="font-size: 120px">
                            <i class="fa-solid fa-circle-exclamation"></i>
                        </span>

                        <br />

                        <p class="text-sm">
                            Yakin Ingin Menghapus Klinik<br />
                            <span class="fw-bold">
                                {{ $id_klinik }} - {{ $nama_klinik }}
                            </span>
                        </p>
                    </div>

                    <form wire:submit.prevent="deleteClinic">
                        <div class="col">
                            <div class="col mt-3 text-center">
                                <button type="submit" class="btn btn-danger btn-sm" data-bs-dismiss="modal"
                                    data-bs-target="#hapusClinic">
                                    <i style="font-size: 15px" class="fas fa-trash" aria-hidden="true"></i>
                                    HAPUS
                                </button>

                                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal"
                                    data-bs-target="#hapusClinic" aria-label="Close" wire:click="resetInputs">
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
