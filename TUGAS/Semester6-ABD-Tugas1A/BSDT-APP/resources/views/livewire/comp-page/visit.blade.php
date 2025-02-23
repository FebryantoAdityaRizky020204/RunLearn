<div class="col">
    <h5 class="mb-3 fw-bold">
        TABLE VISIT
    </h5>
    <div class="col mb-2 bg-dark p-2 rounded-1">
        <button type="button" class="btn btn-sm text-white bg-primary mt-0 mb-0 me-4" data-bs-toggle="modal"
            data-bs-target="#tambahVisit" id="buttonAddVisit">
            <i class="fa-solid fa-plus"></i>
            &nbsp;Tambah Visit
        </button>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Tanggal Kunjungan</th>
                <th scope="col">Pet</th>
                <th scope="col">Vet</th>
                <th scope="col">Clinic</th>
                <th scope="col">Diagnosa</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @if (!$data->isEmpty())
                @foreach ($data as $d)
                    <tr>
                        <th scope="row">{{ $d->visit_id }}</th>
                        <td>{{ $d->visit_date }}</td>
                        <td>{{ $d->pet_id }} - {{ $d->pet->pet_name }}</td>
                        <td>{{ $d->vet_id }} - {{ $d->veterinarian->vet_fullname }}</td>
                        <td>{{ $d->clinic_id }} - {{ $d->veterinarian->clinic->clinic_name }}</td>
                        <td style="max-width: 220px">{{ $d->visit_diaknosa }}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                data-bs-target="#editVisit" id="buttonEditVisit"
                                wire:click='showEditVisit({{ $d->visit_id }})'>
                                <i class="fa-regular fa-pen-to-square"></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#hapusVisit" id="buttonDeleteVisit"
                                wire:click='showHapusVisit({{ $d->visit_id }})'>
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


    {{-- Modal Tambah Visit --}}
    <div wire:ignore.self class="modal fade" id="tambahVisit" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="tambahVisitLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="tambahVisitLabel">TAMBAH VISIT</h1>
                    <button type="button" class="btn-close btn-dark bg-dark" data-bs-dismiss="modal" aria-label="Close"
                        wire:click='resetInputs'></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="addVisit" class=''>

                        <div class="form-group col-12">
                            <label for="visit_id">Visit ID</label>
                            <input wire:model='visit_id' type="string" class="form-control border-2 p-2"
                                id="visit_id" placeholder="" autocomplete="off">
                            @error('visit_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="visit_date">Tanggal Kunjungan</label>
                            <input wire:model='visit_date' type="date" class="form-control border-2 p-2"
                                id="visit_date" placeholder="" autocomplete="off">
                            @error('visit_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="pet_id">Pet</label>
                            <select class="form-select border-2 p-2"
                                aria-label="Default select example"
                                wire:model.live="pet_id"
                                id="pet_id">
                                @if ($clinic->isEmpty())
                                    <option value="">Data Pet Kosong</option>
                                @else
                                    <option value="">-- Pilih Pet --</option>
                                    @foreach ($pet as $pt)
                                        <option value="{{ $pt->pet_id }}">
                                            {{ $pt->pet_id }} - {{ $pt->pet_name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @error('pet_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="vet_id">Vet</label>
                            <select class="form-select border-2 p-2"
                                aria-label="Default select example"
                                wire:model.live="vet_id"
                                id="vet_id">
                                @if ($vet->isEmpty())
                                    <option value="">Data Vet Kosong</option>
                                @else
                                    <option value="">-- Pilih Vet --</option>
                                    @foreach ($vet as $vt)
                                        <option value="{{ $vt->vet_id }}">
                                            {{ $vt->vet_id }} - {{ $vt->vet_fullname }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @error('vet_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="clinic_id">Clinic</label>
                            <select class="form-select border-2 p-2"
                                aria-label="Default select example"
                                wire:model.live="clinic_id"
                                id="clinic_id">
                                @if ($clinic->isEmpty())
                                    <option value="">Data Clinic Kosong</option>
                                @else
                                    <option value="">-- Pilih Clinic --</option>
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

                        <div class="form-group col-12">
                            <label for="visit_diaknosa">Diagnosa</label>
                            <textarea wire:model='visit_diaknosa' class="form-control border-2 p-2" id="visit_diaknosa" rows="3" autocomplete="off"
                            ></textarea>
                            @error('visit_diaknosa')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col">
                            <div class="col mt-3">
                                <button type="submit" class="btn btn-dark btn-sm" data-bs-dismiss="modal"
                                    data-bs-target="#tambahVisit">
                                    <i class="fa-solid fa-plus"></i>
                                    &nbsp;Tambah Visit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm my-1 btn-secondary" data-bs-dismiss="modal"
                        data-bs-target="#tambahVisit" wire:click="resetInputs">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Edit Visit --}}
    <div wire:ignore.self class="modal fade" id="editVisit" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="editVisitLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editVisitLabel">EDIT Visit</h1>
                    <button type="button" class="btn-close btn-dark bg-dark" data-bs-dismiss="modal"
                        aria-label="Close" wire:click='resetInputs'></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="editVisit" class=''>

                        <div class="form-group col-12">
                            <label for="visit_id">Visit ID</label>
                            <input wire:model='visit_id' type="string" class="form-control border-2 p-2"
                                id="visit_id" placeholder="" autocomplete="off" disabled>
                            @error('visit_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="visit_date">Tanggal Kunjungan</label>
                            <input wire:model='visit_date' type="date" class="form-control border-2 p-2"
                                id="visit_date" placeholder="" autocomplete="off">
                            @error('visit_date')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="pet_id">Pet</label>
                            <select class="form-select border-2 p-2"
                                aria-label="Default select example"
                                wire:model.live="pet_id"
                                id="pet_id">
                                @if ($clinic->isEmpty())
                                    <option value="">Data Pet Kosong</option>
                                @else
                                    <option value="">-- Pilih Pet --</option>
                                    @foreach ($pet as $pt)
                                        <option value="{{ $pt->pet_id }}">
                                            {{ $pt->pet_id }} - {{ $pt->pet_name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @error('pet_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="vet_id">Vet</label>
                            <select class="form-select border-2 p-2"
                                aria-label="Default select example"
                                wire:model.live="vet_id"
                                id="vet_id">
                                @if ($vet->isEmpty())
                                    <option value="">Data Vet Kosong</option>
                                @else
                                    <option value="">-- Pilih Vet --</option>
                                    @foreach ($vet as $vt)
                                        <option value="{{ $vt->vet_id }}">
                                            {{ $vt->vet_id }} - {{ $vt->vet_fullname }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @error('vet_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="clinic_id">Clinic</label>
                            <select class="form-select border-2 p-2"
                                aria-label="Default select example"
                                wire:model.live="clinic_id"
                                id="clinic_id">
                                @if ($clinic->isEmpty())
                                    <option value="">Data Clinic Kosong</option>
                                @else
                                    <option value="">-- Pilih Clinic --</option>
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

                        <div class="form-group col-12">
                            <label for="visit_diaknosa">Diagnosa</label>
                            <textarea wire:model='visit_diaknosa' class="form-control border-2 p-2" id="visit_diaknosa" rows="3" autocomplete="off"
                            ></textarea>
                            @error('visit_diaknosa')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col">
                            <div class="col mt-3">
                                <button type="submit" class="btn btn-warning btn-sm" data-bs-dismiss="modal"
                                    data-bs-target="#editVisit">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                    Edit Visit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm my-1 btn-secondary" data-bs-dismiss="modal"
                        data-bs-target="#editVisit" wire:click="resetInputs">Cancel</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Hapus Visit -->
    <div wire:ignore.self class="modal fade" id="hapusVisit" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="hapusVisitLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="col-12 text-center">
                        <span class="text-danger display-5" style="font-size: 120px">
                            <i class="fa-solid fa-circle-exclamation"></i>
                        </span>

                        <br />

                        <p class="text-sm">
                            Yakin Ingin Menghapus Kunjungan<br />
                            <span class="fw-bold">
                                {{ $visit_id }} - {{ $pet_id }} - {{ $visit_date }}
                            </span>
                        </p>
                    </div>

                    <form wire:submit.prevent="deleteVisit">
                        <div class="col">
                            <div class="col mt-3 text-center">
                                <button type="submit" class="btn btn-danger btn-sm" data-bs-dismiss="modal"
                                    data-bs-target="#hapusVisit">
                                    <i style="font-size: 15px" class="fas fa-trash" aria-hidden="true"></i>
                                    HAPUS
                                </button>

                                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal"
                                    data-bs-target="#hapusVisit" aria-label="Close" wire:click="resetInputs">
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
