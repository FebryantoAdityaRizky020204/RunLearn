<div class="col">
    <h5 class="mb-3 fw-bold">
        TABLE PAWRENT - PET
    </h5>
    <div class="col mb-2 bg-dark p-2 rounded-1">
        <button type="button" class="btn btn-sm text-white bg-primary mt-0 mb-0 me-4" data-bs-toggle="modal"
            data-bs-target="#tambahPawrent" id="buttonAddPawrent">
            <i class="fa-solid fa-plus"></i>
            &nbsp;Tambah Pawrent
        </button>
    </div>
    <div class="row">
        <div class="col-6" style="font-size: 13px">
            <div class="row p-2">
                <span class="fw-bold bg-secondary text-white py-1 p-2 rounded-1">PAWRENT</span>
            </div>
            <table class="table">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">No Telp</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!$data->isEmpty())
                        @foreach ($data as $d)
                            <tr>
                                <th scope="row">{{ $d->paw_id }}</th>
                                <td>{{ $d->paw_fullname }}</td>
                                <td>{{ $d->paw_num_telp }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#editPawrent" id="buttonEditPawrent"
                                        wire:click='showEditPawrent({{ $d->paw_id }})'>
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#hapusPawrent" id="buttonDeletePawrent"
                                        wire:click='showHapusPawrent({{ $d->paw_id }})'>
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                    <button type="button" class="btn btn-dark btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#tambahPet" id="buttonTambahPet"
                                        wire:click='showTambahPet({{ $d->paw_id }})'>
                                        <i class="fa-solid fa-paw"></i>
                                        <span class="fw-bold">PET</span>
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
        </div>

        <div class="col-6" style="font-size: 13px">
            <div class="row p-2">
                <span class="fw-bold bg-secondary text-white py-1 p-2 rounded-1">PET</span>
            </div>
            <table class="table">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Tahun Lahir</th>
                        <th scope="col">Type</th>
                        <th scope="col">Pemilik</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (!$pet->isEmpty())
                        @foreach ($pet as $p)
                            <tr>
                                <th scope="row">{{ $p->pet_id }}</th>
                                <td>{{ $p->pet_name }}</td>
                                <td>{{ $p->pet_year_of_birth }}</td>
                                <td>{{ $p->pet_type }}</td>
                                <td>{{ $p->paw_id }} - {{ $p->pawrent->paw_fullname }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#editPet" id="buttonEditPet"
                                        wire:click='showEditPet({{ $p->pet_id }})'>
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#hapusPet" id="buttonDeletePet"
                                        wire:click='showHapusPet({{ $p->pet_id }})'>
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="text-center fw-bold">Data Kosong</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>


    {{-- Modal Tambah Pawrent --}}
    <div wire:ignore.self class="modal fade" id="tambahPawrent" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="tambahPawrentLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="tambahPawrentLabel">TAMBAH PAWRENT</h1>
                    <button type="button" class="btn-close btn-dark bg-dark" data-bs-dismiss="modal" aria-label="Close"
                        wire:click='resetInputs'></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="addPawrent" class=''>

                        <div class="form-group col-12">
                            <label for="paw_id">ID</label>
                            <input wire:model='paw_id' type="string" class="form-control border-2 p-2" id="paw_id"
                                placeholder="" autocomplete="off">
                            @error('paw_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="paw_fullname">Nama Pawrent</label>
                            <input wire:model='paw_fullname' type="string" class="form-control border-2 p-2"
                                id="paw_fullname" placeholder="" autocomplete="off">
                            @error('paw_fullname')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="paw_num_telp">No Telp</label>
                            <input wire:model='paw_num_telp' type="number" class="form-control border-2 p-2"
                                id="paw_num_telp" placeholder="" autocomplete="off">
                            @error('paw_num_telp')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col">
                            <div class="col mt-3">
                                <button type="submit" class="btn btn-dark btn-sm" data-bs-dismiss="modal"
                                    data-bs-target="#tambahPawrent">
                                    <i class="fa-solid fa-plus"></i>
                                    &nbsp;Tambah Pawrent
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm my-1 btn-secondary" data-bs-dismiss="modal"
                        data-bs-target="#tambahPawrent" wire:click="resetInputs">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Edit Pawrent --}}
    <div wire:ignore.self class="modal fade" id="editPawrent" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="editPawrentLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editPawrentLabel">EDIT Pawrent</h1>
                    <button type="button" class="btn-close btn-dark bg-dark" data-bs-dismiss="modal"
                        aria-label="Close" wire:click='resetInputs'></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="editPawrent" class=''>

                        <div class="form-group col-12">
                            <label for="paw_id">ID</label>
                            <input wire:model='paw_id' type="string" class="form-control border-2 p-2"
                                id="paw_id" placeholder="" autocomplete="off" disabled>
                            @error('paw_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="paw_fullname">Nama Pawrent</label>
                            <input wire:model='paw_fullname' type="string" class="form-control border-2 p-2"
                                id="paw_fullname" placeholder="" autocomplete="off">
                            @error('paw_fullname')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="paw_num_telp">No Telp</label>
                            <input wire:model='paw_num_telp' type="number" class="form-control border-2 p-2"
                                id="paw_num_telp" placeholder="" autocomplete="off">
                            @error('paw_num_telp')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col">
                            <div class="col mt-3">
                                <button type="submit" class="btn btn-warning btn-sm" data-bs-dismiss="modal"
                                    data-bs-target="#editPawrent">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                    Edit Pawrent
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm my-1 btn-secondary" data-bs-dismiss="modal"
                        data-bs-target="#editPawrent" wire:click="resetInputs">Cancel</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Hapus Pengeluaran -->
    <div wire:ignore.self class="modal fade" id="hapusPawrent" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="hapusPawrentLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="col-12 text-center">
                        <span class="text-danger display-5" style="font-size: 120px">
                            <i class="fa-solid fa-circle-exclamation"></i>
                        </span>

                        <br />

                        <p class="text-sm">
                            Yakin Ingin Menghapus Pawrent<br />
                            <span class="fw-bold">
                                {{ $paw_id }} - {{ $paw_fullname }}
                            </span>
                            <br />
                            <span class="badge text-bg-danger">!!Data Pet juga akan Dihapus</span>
                        </p>
                    </div>

                    <form wire:submit.prevent="deletePawrent">
                        <div class="col">
                            <div class="col mt-3 text-center">
                                <button type="submit" class="btn btn-danger btn-sm" data-bs-dismiss="modal"
                                    data-bs-target="#hapusPawrent">
                                    <i style="font-size: 15px" class="fas fa-trash" aria-hidden="true"></i>
                                    HAPUS
                                </button>

                                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal"
                                    data-bs-target="#hapusPawrent" aria-label="Close" wire:click="resetInputs">
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


    {{-- Modal Tambah Pet --}}
    <div wire:ignore.self class="modal fade" id="tambahPet" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="tambahPetLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="tambahPetLabel">TAMBAH PET</h1>
                    <button type="button" class="btn-close btn-dark bg-dark" data-bs-dismiss="modal" aria-label="Close"
                        wire:click='resetInputs'></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="addPet" class=''>

                        <div class="form-group col-12">
                            <label for="paw_id">PAWRENT</label>
                            {{-- <input wire:model='paw_id' type="string" class="form-control border-2 p-2" id="paw_id"
                                placeholder="" autocomplete="off"> --}}
                            <select class="form-select border-2 p-2"
                                aria-label="Default select example"
                                wire:model="paw_id"
                                id="paw_id" disabled>
                                <option value="{{ $paw_id }}"> {{ $paw_id }} - {{ $paw_fullname }}</option>
                            </select>
                            @error('paw_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="pet_id">ID Pet</label>
                            <input wire:model='pet_id' type="string" class="form-control border-2 p-2" id="pet_id"
                                placeholder="" autocomplete="off">
                            @error('paw_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="pet_name">Nama Pet</label>
                            <input wire:model='pet_name' type="string" class="form-control border-2 p-2"
                                id="pet_name" placeholder="" autocomplete="off">
                            @error('pet_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="pet_year_of_birth">Tahun Lahir</label>
                            <input wire:model='pet_year_of_birth' type="number" min="1900" max="{{ date('Y') }}" 
                            class="form-control border-2 p-2" oninput="this.value = this.value.slice(0,4)" 
                            id="pet_year_of_birth" placeholder="" autocomplete="off">
                            @error('pet_year_of_birth')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="pet_type">Type Pet</label>
                            <input wire:model='pet_type' type="string" class="form-control border-2 p-2"
                                id="pet_type" placeholder="" autocomplete="off">
                            @error('pet_type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col">
                            <div class="col mt-3">
                                <button type="submit" class="btn btn-dark btn-sm" data-bs-dismiss="modal"
                                    data-bs-target="#tambahPet">
                                    <i class="fa-solid fa-plus"></i>
                                    &nbsp;Tambah Pet
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm my-1 btn-secondary" data-bs-dismiss="modal"
                        data-bs-target="#tambahPet" wire:click="resetInputs">Cancel</button>
                </div>
            </div>
        </div>
    </div>


    {{-- Modal Edit Pet --}}
    <div wire:ignore.self class="modal fade" id="editPet" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="editPetLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editPetLabel">EDIT PET</h1>
                    <button type="button" class="btn-close btn-dark bg-dark" data-bs-dismiss="modal"
                        aria-label="Close" wire:click='resetInputs'></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="editPet" class=''>

                        <div class="form-group col-12">
                            <label for="paw_id">PAWRENT</label>
                            <select class="form-select border-2 p-2"
                                aria-label="Default select example"
                                wire:model="paw_id"
                                id="paw_id" disabled>
                                <option value="{{ $paw_id }}"> {{ $paw_id }}</option>
                            </select>
                            @error('paw_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="pet_id">ID Pet</label>
                            <input wire:model='pet_id' type="string" class="form-control border-2 p-2" id="pet_id"
                                placeholder="" autocomplete="off" disabled>
                            @error('paw_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="pet_name">Nama Pet</label>
                            <input wire:model='pet_name' type="string" class="form-control border-2 p-2"
                                id="pet_name" placeholder="" autocomplete="off">
                            @error('pet_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="pet_year_of_birth">Tahun Lahir</label>
                            <input wire:model='pet_year_of_birth' type="number" min="1900" max="{{ date('Y') }}" 
                            class="form-control border-2 p-2" oninput="this.value = this.value.slice(0,4)" 
                            id="pet_year_of_birth" placeholder="" autocomplete="off">
                            @error('pet_year_of_birth')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="pet_type">Type Pet</label>
                            <input wire:model='pet_type' type="string" class="form-control border-2 p-2"
                                id="pet_type" placeholder="" autocomplete="off">
                            @error('pet_type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col">
                            <div class="col mt-3">
                                <button type="submit" class="btn btn-warning btn-sm" data-bs-dismiss="modal"
                                    data-bs-target="#editPet">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                    Edit Pet
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm my-1 btn-secondary" data-bs-dismiss="modal"
                        data-bs-target="#editPet" wire:click="resetInputs">Cancel</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Hapus Pet -->
    <div wire:ignore.self class="modal fade" id="hapusPet" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="hapusPetLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="col-12 text-center">
                        <span class="text-danger display-5" style="font-size: 120px">
                            <i class="fa-solid fa-circle-exclamation"></i>
                        </span>

                        <br />

                        <p class="text-sm">
                            Yakin Ingin Menghapus Pet<br />
                            <span class="fw-bold">
                                {{ $pet_id }} - {{ $pet_name }}
                            </span>
                        </p>
                    </div>

                    <form wire:submit.prevent="deletePet">
                        <div class="col">
                            <div class="col mt-3 text-center">
                                <button type="submit" class="btn btn-danger btn-sm" data-bs-dismiss="modal"
                                    data-bs-target="#hapusPet">
                                    <i style="font-size: 15px" class="fas fa-trash" aria-hidden="true"></i>
                                    HAPUS
                                </button>

                                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal"
                                    data-bs-target="#hapusPet" aria-label="Close" wire:click="resetInputs">
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
