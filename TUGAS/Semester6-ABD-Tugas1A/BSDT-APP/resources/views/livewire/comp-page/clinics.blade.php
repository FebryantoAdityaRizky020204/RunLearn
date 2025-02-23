<div class="col">
    <div class="row">
        <div class="col-9">
            <h3 class="mb-3">Clinics</h3>

            <button type="button" class="btn btn-primary btn-sm fw-bold" data-bs-toggle="modal"
                data-bs-target="#tambahClinic" id="buttonAddClinic">
                <i class="fa-solid fa-house-medical-circle-check"></i>
                Tambah Klinik
            </button>
        </div>
        <div class="col align-self-end">

        </div>
    </div>

    <div class="row">
        @if (!$clinics->isEmpty())
            @foreach ($clinics as $clinic)
                <div class="col-sm-4 mb-3 mb-sm-0 mt-2">
                    <div class="card border-primary">
                        <div class="card-header bg-primary fw-bold text-light">
                            Klinik #{{ $clinic->clinic_id }}
                        </div>
                        <div class="card-body py-2">
                            <h4 class="card-title">{{ $clinic->clinic_name }}</h4>
                            <p class="card-text">
                                {{ $clinic->clinic_address }} <br />
                                <span class="fw-bold text-body-secondary lead " style="font-size: 14px">
                                    <em>Telp. {{ $clinic->clinic_num_telp }}</em>
                                </span>
                            </p>
                            <button type="button" class="btn btn-primary btn-sm fw-bold" data-bs-toggle="modal"
                                data-bs-target="#tambahVeterinarian" id="buttonAddVeterinarian"
                                wire:click='showAddVeterinarian({{ $clinic->clinic_id }})'>
                                <i class="fa-solid fa-user-doctor"></i>
                                Tambah Doctor
                            </button>
                            <button type="button" class="btn btn-warning btn-sm fw-bold" data-bs-toggle="modal"
                                data-bs-target="#tambahVeterinarianSpecialist" id="buttonAddVeterinarianSpecialist"
                                wire:click='showAddVeterinarianSpecialist({{ $clinic->clinic_id }})'>
                                <i class="fa-solid fa-brain"></i>
                                Set Specialist
                            </button>
                        </div>

                        <div class="card-footer">
                            @if ($clinic->veterinarians != null)
                                <ul class="list-group">
                                    @foreach ($clinic->veterinarians as $vet)
                                        <li href="#"
                                            class="list-group-item list-group-item-action active mb-2 px-2"
                                            aria-current="true">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h5 class="mb-1">{{ $vet->vet_fullname }}</h5>
                                                <span class="fw-bold p-1 badge text-bg-light rounded"
                                                    style="font-size: 12px;">
                                                    Dokter Tetap
                                                </span>
                                            </div>
                                            <span class="fw-bold text-light lead " style="font-size: 14px">
                                                <em>Telp. {{ $vet->vet_num_telp }}</em>
                                            </span>
                                            <br />
                                            <small>
                                                {{ $vet->vet_start_date }}
                                                <span
                                                    class="badge {{ $vet->vet_contract_status == 'Aktif' ? 'text-bg-success' : 'text-bg-danger' }} ">
                                                    {{ $vet->vet_contract_status }}
                                                </span>
                                            </small> <br />
                                            @if ($vet->veterinarianSpecialist != null)
                                                <small class="badge text-bg-warning">
                                                    <em>Specialist
                                                        {{ $vet->veterinarianSpecialist->specialist_field }}</em>
                                                </small>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <ul class="list-group">
                                    <li href="#"
                                        class="list-group-item list-group-item-action border-primary text-primary mb-2 px-2"
                                        aria-current="true">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1">Belum Ada Dokter</h5>
                                        </div>
                                    </li>
                                </ul>
                            @endif

                            @if ($clinic->getScopeVetSp($clinic->clinic_id)->isNotEmpty())
                                <ul class="list-group">
                                    @foreach ($clinic->getScopeVetSp($clinic->clinic_id) as $vet_sp)
                                        @if ($vet_sp->veterinarian->clinic_id != $clinic->clinic_id)
                                            <li href="#"
                                                class="list-group-item list-group-item-action active mb-2 px-2"
                                                aria-current="true">
                                                <div class="d-flex w-100 justify-content-between">
                                                    <h5 class="mb-1">{{ $vet_sp->veterinarian->vet_fullname }}</h5>
                                                    {{-- <span class="fw-bold p-1 badge text-bg-light rounded"
                                                        style="font-size: 12px;">
                                                        Dokter Tetap
                                                    </span> --}}
                                                </div>
                                                <span class="fw-bold text-light lead " style="font-size: 14px">
                                                    <em>Telp. {{ $vet_sp->veterinarian->vet_num_telp }}</em>
                                                </span>
                                                <br />
                                                <small>
                                                    {{ $vet_sp->veterinarian->vet_start_date }}
                                                    <span
                                                        class="badge {{ $vet_sp->veterinarian->vet_contract_status == 'Aktif' ? 'text-bg-success' : 'text-bg-danger' }} ">
                                                        {{ $vet_sp->veterinarian->vet_contract_status }}
                                                    </span>
                                                </small> <br />
                                                @if ($vet_sp->veterinarian->veterinarianSpecialist != null)
                                                    <small class="badge text-bg-warning">
                                                        <em>Specialist
                                                            {{ $vet_sp->veterinarian->veterinarianSpecialist->specialist_field }}</em>
                                                    </small>
                                                @endif
                                            </li>
                                        @endif
                                    @endforeach
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
                        <h4 class="card-title">Klinik Kosong</h4>
                    </div>
                </div>
            </div>
        @endif

        {{-- Modal Tambah Clinic --}}
        <div wire:ignore.self class="modal fade" id="tambahClinic" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="tambahClinicLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="tambahClinicLabel">TAMBAH CLINIC</h1>
                        <button type="button" class="btn-close btn-dark bg-dark" data-bs-dismiss="modal"
                            aria-label="Close" wire:click='resetInputs'></button>
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
                                <input wire:model='nomor_telepon_klinik' type="number"
                                    class="form-control border-2 p-2" id="nomor_telepon_klinik" placeholder=""
                                    autocomplete="off">
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


        {{-- Modal Tambah Veterinarian --}}
        <div wire:ignore.self class="modal fade" id="tambahVeterinarian" data-bs-backdrop="static"
            data-bs-keyboard="false" tabindex="-1" aria-labelledby="tambahVeterinarianLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="tambahVeterinarianLabel">TAMBAH VETERINARIAN</h1>
                        <button type="button" class="btn-close btn-dark bg-dark" data-bs-dismiss="modal"
                            aria-label="Close" wire:click='resetInputs'></button>
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
                                <select class="form-select border-2 p-2" aria-label="Default select example"
                                    wire:model.live="vet_contract_status" id="vet_contract_status">
                                    <option value="">-- Pilih Status --</option>
                                    <option value="Aktif">Aktif</option>
                                    <option value="Tidak Aktif">Tidak Aktif</option>
                                </select>
                                @error('vet_contract_status')
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


        {{-- Modal Tambah VeterinarianSpecialist --}}
        <div wire:ignore.self class="modal fade" id="tambahVeterinarianSpecialist" data-bs-backdrop="static"
            data-bs-keyboard="false" tabindex="-1" aria-labelledby="tambahVeterinarianSpecialistLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="tambahVeterinarianSpecialistLabel">TAMBAH VETERINARIAN
                            SPECIALIST</h1>
                        <button type="button" class="btn-close btn-dark bg-dark" data-bs-dismiss="modal"
                            aria-label="Close" wire:click='resetInputs'></button>
                    </div>
                    <div class="modal-body">
                        <form wire:submit.prevent="addVeterinarianSpecialist" class=''>

                            <div class="form-group col-12">
                                <label for="vet_sp_id">VET SP ID</label>
                                <input wire:model='vet_sp_id' type="string" class="form-control border-2 p-2"
                                    id="vet_sp_id" placeholder="" autocomplete="off">
                                @error('vet_sp_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-12">
                                <label for="vet_id">Vet</label>
                                <select class="form-select border-2 p-2" aria-label="Default select example"
                                    wire:model.live="vet_id" id="vet_id">
                                    @if (!$vets->isEmpty())
                                        <option value="">-- Pilih Vet --</option>
                                        @foreach ($vets as $vet)
                                            <option value="{{ $vet->vet_id }}">
                                                {{ $vet->vet_id }} - {{ $vet->vet_fullname }}
                                            </option>
                                        @endforeach
                                    @else
                                        <option value="">Data Vet Kosong</option>
                                    @endif
                                </select>
                                @error('vet_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-12">
                                <label for="specialist_field">Spesialis</label>
                                <input wire:model='specialist_field' type="string" class="form-control border-2 p-2"
                                    id="specialist_field" placeholder="" autocomplete="off">
                                @error('specialist_field')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-12">
                                <label for="vet_sp_contract_status">Status Kontrak</label>
                                <select class="form-select border-2 p-2" aria-label="Default select example"
                                    wire:model.live="vet_sp_contract_status" id="vet_sp_contract_status">
                                    <option value="">-- Pilih Status --</option>
                                    <option value="Aktif">Aktif</option>
                                    <option value="Tidak Aktif">Tidak Aktif</option>
                                </select>
                                @error('vet_sp_contract_status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col">
                                <div class="col mt-3">
                                    <button type="submit" class="btn btn-dark btn-sm" data-bs-dismiss="modal"
                                        data-bs-target="#tambahVeterinarianSpecialist">
                                        <i class="fa-solid fa-plus"></i>
                                        &nbsp;Tambah VeterinarianSpecialist
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm my-1 btn-secondary" data-bs-dismiss="modal"
                            data-bs-target="#tambahVeterinarianSpecialist" wire:click="resetInputs">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>