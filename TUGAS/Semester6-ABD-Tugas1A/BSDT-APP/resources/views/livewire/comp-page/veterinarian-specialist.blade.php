<div class="col">
    <h5 class="mb-3 fw-bold">
        TABLE VETERINARIAN SPECIALIST
    </h5>
    <div class="col mb-2 bg-dark p-2 rounded-1">
        <button type="button" class="btn btn-sm text-white bg-primary mt-0 mb-0 me-4" data-bs-toggle="modal"
            data-bs-target="#tambahVeterinarianSpecialist" id="buttonAddVeterinarianSpecialist">
            <i class="fa-solid fa-plus"></i>
            &nbsp;Tambah Veterinarian Specialist
        </button>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">VET SP ID</th>
                <th scope="col">VET</th>
                <th scope="col">Specialist</th>
                <th scope="col">Contract Status</th>
                <th scope="col">Klinik</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @if (!$data->isEmpty())
                @foreach ($data as $d)
                    <tr>
                        <th scope="row">{{ $d->vet_sp_id }}</th>
                        <td>{{ $d->vet_id }} - {{ $d->veterinarian->vet_fullname }}</td>
                        <td>{{ $d->specialist_field }}</td>
                        <td>{{ $d->vet_sp_contract_status }}</td>
                        <td>{{ $d->clinic_id }} - {{ $d->veterinarian->clinic->clinic_name }}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                data-bs-target="#editVeterinarianSpecialist" id="buttonEditVeterinarianSpecialist"
                                wire:click='showEditVeterinarianSpecialist({{ $d->vet_sp_id }})'>
                                <i class="fa-regular fa-pen-to-square"></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#hapusVeterinarianSpecialist" id="buttonDeleteVeterinarianSpecialist"
                                wire:click='showHapusVeterinarianSpecialist({{ $d->vet_sp_id }})'>
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


    {{-- Modal Tambah VeterinarianSpecialist --}}
    <div wire:ignore.self class="modal fade" id="tambahVeterinarianSpecialist" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="tambahVeterinarianSpecialistLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="tambahVeterinarianSpecialistLabel">TAMBAH VETERINARIAN SPECIALIST</h1>
                    <button type="button" class="btn-close btn-dark bg-dark" data-bs-dismiss="modal" aria-label="Close"
                        wire:click='resetInputs'></button>
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
                            <label for="vet_id">Vet ID</label>
                            {{-- <input wire:model='vet_id' type="string" class="form-control border-2 p-2"
                                id="vet_id" placeholder="" autocomplete="off"> --}}
                            <select class="form-select border-2 p-2"
                                aria-label="Default select example"
                                wire:model.live="vet_id"
                                id="vet_id">
                                @if ($vet->isEmpty())
                                    <option value="">Data Vet Kosong</option>
                                @else
                                    <option value="">-- Pilih Klinik --</option>
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
                            <label for="specialist_field">Spesialis</label>
                            <input wire:model='specialist_field' type="string" class="form-control border-2 p-2"
                                id="specialist_field" placeholder="" autocomplete="off">
                            @error('specialist_field')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="vet_sp_contract_status">Status Kontrak</label>
                            <select class="form-select border-2 p-2"
                                aria-label="Default select example"
                                wire:model.live="vet_sp_contract_status"
                                id="vet_sp_contract_status">
                                <option value="">-- Pilih Status --</option>
                                <option value="Aktif">Aktif</option>
                                <option value="Tidak Aktif">Tidak Aktif</option>
                            </select>
                            @error('vet_sp_contract_status')
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

    {{-- Modal Edit VeterinarianSpecialist --}}
    <div wire:ignore.self class="modal fade" id="editVeterinarianSpecialist" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="editVeterinarianSpecialistLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editVeterinarianSpecialistLabel">EDIT Veterinarian Specialist</h1>
                    <button type="button" class="btn-close btn-dark bg-dark" data-bs-dismiss="modal"
                        aria-label="Close" wire:click='resetInputs'></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="editVeterinarianSpecialist" class=''>

                        <div class="form-group col-12">
                            <label for="vet_sp_id">VET SP ID</label>
                            <input wire:model='vet_sp_id' type="string" class="form-control border-2 p-2"
                                id="vet_sp_id" placeholder="" autocomplete="off">
                            @error('vet_sp_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="vet_id">Vet ID</label>
                            {{-- <input wire:model='vet_id' type="string" class="form-control border-2 p-2"
                                id="vet_id" placeholder="" autocomplete="off"> --}}
                            <select class="form-select border-2 p-2"
                                aria-label="Default select example"
                                wire:model.live="vet_id"
                                id="vet_id">
                                @if ($vet->isEmpty())
                                    <option value="">Data Vet Kosong</option>
                                @else
                                    <option value="">-- Pilih Klinik --</option>
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
                            <label for="specialist_field">Spesialis</label>
                            <input wire:model='specialist_field' type="string" class="form-control border-2 p-2"
                                id="specialist_field" placeholder="" autocomplete="off">
                            @error('specialist_field')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="vet_sp_contract_status">Status Kontrak</label>
                            <select class="form-select border-2 p-2"
                                aria-label="Default select example"
                                wire:model.live="vet_sp_contract_status"
                                id="vet_sp_contract_status">
                                <option value="">-- Pilih Status --</option>
                                <option value="Aktif">Aktif</option>
                                <option value="Tidak Aktif">Tidak Aktif</option>
                            </select>
                            @error('vet_sp_contract_status')
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
                                    data-bs-target="#editVeterinarianSpecialist">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                    Edit VeterinarianSpecialist
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm my-1 btn-secondary" data-bs-dismiss="modal"
                        data-bs-target="#editVeterinarianSpecialist" wire:click="resetInputs">Cancel</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Hapus Pengeluaran -->
    <div wire:ignore.self class="modal fade" id="hapusVeterinarianSpecialist" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="hapusVeterinarianSpecialistLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="col-12 text-center">
                        <span class="text-danger display-5" style="font-size: 120px">
                            <i class="fa-solid fa-circle-exclamation"></i>
                        </span>

                        <br />
                        <br />

                        <p class="text-sm">
                            Yakin Ingin Menghapus Vet Specialist<br />
                            <span class="fw-bold">
                                {{ $vet_sp_id }} - {{ $specialist_field }} - {{ $vet_id }}
                            </span>
                        </p>
                    </div>

                    <form wire:submit.prevent="deleteVeterinarianSpecialist">
                        <div class="col">
                            <div class="col mt-3 text-center">
                                <button type="submit" class="btn btn-danger btn-sm" data-bs-dismiss="modal"
                                    data-bs-target="#hapusVeterinarianSpecialist">
                                    <i style="font-size: 15px" class="fas fa-trash" aria-hidden="true"></i>
                                    HAPUS
                                </button>

                                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal"
                                    data-bs-target="#hapusVeterinarianSpecialist" aria-label="Close" wire:click="resetInputs">
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
