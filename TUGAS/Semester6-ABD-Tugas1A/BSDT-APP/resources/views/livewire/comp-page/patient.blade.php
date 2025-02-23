<div class="col">
    <div class="row">
        <div class="col-9">
            <h3 class="mb-3">Patient</h3>
            <button type="button" class="btn btn-primary btn-sm fw-bold" data-bs-toggle="modal"
                data-bs-target="#tambahPawrent" id="buttonAddPawrent">
                <i class="fa-solid fa-person-circle-plus"></i>
                Tambah Pawrent
            </button>
        </div>
        <div class="col align-self-end">

        </div>
    </div>

    <div class="row">
        @if (!$pawrents->isEmpty())
            @foreach ($pawrents as $paw)
                <div class="col-sm-4 mb-3 mb-sm-0 mt-2">
                    <div class="card border-primary">
                        <div class="card-header bg-primary fw-bold text-light">
                            Pawrent #{{ $paw->paw_id }}
                        </div>
                        <div class="card-body py-2">
                            <h4 class="card-title">{{ $paw->paw_fullname }}</h4>
                            <p class="card-text">
                                <span class="fw-bold text-body-secondary lead " style="font-size: 14px">
                                    <em>Telp. {{ $paw->paw_num_telp }}</em>
                                </span>
                            </p>
                            <button type="button" class="btn btn-primary btn-sm fw-bold" data-bs-toggle="modal"
                                    data-bs-target="#tambahPet" id="buttonTambahPet"
                                    wire:click='showTambahPet({{ $paw->paw_id }})'>
                                <i class="fa-solid fa-paw"></i>
                                Tambah Pet
                            </button>
                        </div>

                        <div class="card-footer">
                            @if ($paw->pets->isNotEmpty())
                                <ul class="list-group">
                                    @foreach ($paw->pets as $pet)
                                        <li href="#"
                                            class="list-group-item list-group-item-action active mb-2 px-2"
                                            aria-current="true">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h5 class="mb-1">{{ $pet->pet_name }}</h5>
                                                <span class="fw-bold p-1 badge text-bg-light rounded"
                                                    style="font-size: 12px;">
                                                    Thn Lahir: {{ $pet->pet_year_of_birth }}
                                                </span>
                                            </div>
                                            <span class="fw-bold text-light lead " style="font-size: 14px">
                                                <em>Type: {{ $pet->pet_type }}</em>
                                            </span>
                                            <br />
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <ul class="list-group">
                                    <li href="#"
                                        class="list-group-item list-group-item-action border-primary text-primary mb-2 px-2"
                                        aria-current="true">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1">Belum Ada Pet</h5>
                                        </div>
                                    </li>
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-sm-4 mb-3 mb-sm-0 mt-2">
                <div class="card border-primary">
                    <div class="card-body py-2">
                        <h4 class="card-title">Pawrent Kosong</h4>
                    </div>
                </div>
            </div>
        @endif
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

</div>
