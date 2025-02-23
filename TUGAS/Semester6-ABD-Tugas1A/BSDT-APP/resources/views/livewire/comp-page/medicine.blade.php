<div class="col">
    <h5 class="mb-3 fw-bold">
        TABLE MEDICINE
    </h5>
    <div class="col mb-2 bg-dark p-2 rounded-1">
        <button type="button" class="btn btn-sm text-white bg-primary mt-0 mb-0 me-4" data-bs-toggle="modal"
            data-bs-target="#tambahMedicine" id="buttonAddMedicine">
            <i class="fa-solid fa-plus"></i>
            &nbsp;Tambah Medicine
        </button>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nama Obat</th>
                <th scope="col">Petunjuk Penggunaan</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @if (!$data->isEmpty())
                @foreach ($data as $d)
                    <tr>
                        <th scope="row">{{ $d->med_id }}</th>
                        <td>{{ $d->med_name }}</td>
                        <td>{{ $d->med_direction }}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                data-bs-target="#editMedicine" id="buttonEditMedicine"
                                wire:click='showEditMedicine({{ $d->med_id }})'>
                                <i class="fa-regular fa-pen-to-square"></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#hapusMedicine" id="buttonDeleteMedicine"
                                wire:click='showHapusMedicine({{ $d->med_id }})'>
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="4" class="text-center fw-bold">Data Kosong</td>
                </tr>
            @endif
        </tbody>
    </table>


    {{-- Modal Tambah Medicine --}}
    <div wire:ignore.self class="modal fade" id="tambahMedicine" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="tambahMedicineLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="tambahMedicineLabel">TAMBAH MEDICINE</h1>
                    <button type="button" class="btn-close btn-dark bg-dark" data-bs-dismiss="modal" aria-label="Close"
                        wire:click='resetInputs'></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="addMedicine" class=''>
                        <div class="form-group col-12">
                            <label for="med_id">Med ID</label>
                            <input wire:model='med_id' type="string" class="form-control border-2 p-2"
                                id="med_id" placeholder="" autocomplete="off">
                            @error('med_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="med_name">Nama Obat</label>
                            <input wire:model='med_name' type="string" class="form-control border-2 p-2"
                                id="med_name" placeholder="" autocomplete="off">
                            @error('med_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="med_direction">Petunjuk Penggunaan</label>
                            <textarea wire:model='med_direction' class="form-control border-2 p-2" id="med_direction" rows="3" autocomplete="off"
                            ></textarea>
                            @error('med_direction')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col">
                            <div class="col mt-3">
                                <button type="submit" class="btn btn-dark btn-sm" data-bs-dismiss="modal"
                                    data-bs-target="#tambahMedicine">
                                    <i class="fa-solid fa-plus"></i>
                                    &nbsp;Tambah Medicine
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm my-1 btn-secondary" data-bs-dismiss="modal"
                        data-bs-target="#tambahMedicine" wire:click="resetInputs">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Edit Medicine --}}
    <div wire:ignore.self class="modal fade" id="editMedicine" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="editMedicineLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editMedicineLabel">EDIT Medicine</h1>
                    <button type="button" class="btn-close btn-dark bg-dark" data-bs-dismiss="modal"
                        aria-label="Close" wire:click='resetInputs'></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="editMedicine" class=''>

                        <div class="form-group col-12">
                            <label for="med_id">Med ID</label>
                            <input wire:model='med_id' type="string" class="form-control border-2 p-2"
                                id="med_id" placeholder="" autocomplete="off" disabled>
                            @error('med_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="med_name">Nama Obat</label>
                            <input wire:model='med_name' type="string" class="form-control border-2 p-2"
                                id="med_name" placeholder="" autocomplete="off">
                            @error('med_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="med_direction">Petunjuk Penggunaan</label>
                            <textarea wire:model='med_direction' class="form-control border-2 p-2" id="med_direction" rows="3" autocomplete="off"
                            ></textarea>
                            @error('med_direction')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col">
                            <div class="col mt-3">
                                <button type="submit" class="btn btn-warning btn-sm" data-bs-dismiss="modal"
                                    data-bs-target="#editMedicine">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                    Edit Medicine
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm my-1 btn-secondary" data-bs-dismiss="modal"
                        data-bs-target="#editMedicine" wire:click="resetInputs">Cancel</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Hapus Pengeluaran -->
    <div wire:ignore.self class="modal fade" id="hapusMedicine" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="hapusMedicineLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="col-12 text-center">
                        <span class="text-danger display-5" style="font-size: 120px">
                            <i class="fa-solid fa-circle-exclamation"></i>
                        </span>

                        <br />

                        <p class="text-sm">
                            Yakin Ingin Menghapus Obat<br />
                            <span class="fw-bold">
                                {{ $med_id }} - {{ $med_name }}
                            </span>
                        </p>
                    </div>

                    <form wire:submit.prevent="deleteMedicine">
                        <div class="col">
                            <div class="col mt-3 text-center">
                                <button type="submit" class="btn btn-danger btn-sm" data-bs-dismiss="modal"
                                    data-bs-target="#hapusMedicine">
                                    <i style="font-size: 15px" class="fas fa-trash" aria-hidden="true"></i>
                                    HAPUS
                                </button>

                                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal"
                                    data-bs-target="#hapusMedicine" aria-label="Close" wire:click="resetInputs">
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
