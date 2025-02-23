<div class="col">
    <h5 class="mb-3 fw-bold">
        TABLE FOLLOW UP VISIT
    </h5>
    <div class="col mb-2 bg-dark p-2 rounded-1">
        <button type="button" class="btn btn-sm text-white bg-primary mt-0 mb-0 me-4" data-bs-toggle="modal"
            data-bs-target="#tambahFUVisit" id="buttonAddFUVisit">
            <i class="fa-solid fa-plus"></i>
            &nbsp;Tambah F. U. Visit
        </button>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">F.U. Visit ID</th>
                <th scope="col">Visit Prev</th>
                <th scope="col">F.U. Visit Action</th>
                <th scope="col">Visit Id</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @if (!$data->isEmpty())
                @foreach ($data as $d)
                    <tr>
                        <th scope="row">{{ $d->fu_visit_id }}</th>
                        <td>{{ $d->visit_previous }}</td>
                        <td>{{ $d->fu_visit_action }}</td>
                        <td>{{ $d->visit_id }}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                data-bs-target="#editFUVisit" id="buttonEditFUVisit"
                                wire:click='showEditFUVisit({{ $d->fu_visit_id }})'>
                                <i class="fa-regular fa-pen-to-square"></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#hapusFUVisit" id="buttonDeleteFUVisit"
                                wire:click='showHapusFUVisit({{ $d->fu_visit_id }})'>
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

    {{-- Modal Tambah FUVisit --}}
    <div wire:ignore.self class="modal fade" id="tambahFUVisit" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="tambahFUVisitLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="tambahFUVisitLabel">TAMBAH FUVISIT</h1>
                    <button type="button" class="btn-close btn-dark bg-dark" data-bs-dismiss="modal" aria-label="Close"
                        wire:click='resetInputs'></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="addFUVisit" class=''>

                        <div class="form-group col-12">
                            <label for="fu_visit_id">F.U. Visit ID</label>
                            <input wire:model='fu_visit_id' type="string" class="form-control border-2 p-2"
                                id="fu_visit_id" placeholder="" autocomplete="off">
                            @error('fu_visit_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="visit_previous">Visit Prev</label>
                            <input wire:model='visit_previous' type="string" class="form-control border-2 p-2"
                                id="visit_previous" placeholder="" autocomplete="off">
                            @error('visit_previous')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="fu_visit_action">F.U. Visit Action</label>
                            <textarea wire:model='fu_visit_action' class="form-control border-2 p-2" id="fu_visit_action" rows="3" autocomplete="off"
                            ></textarea>
                            @error('fu_visit_action')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="visit_id">Visit</label>
                            <select class="form-select border-2 p-2"
                                aria-label="Default select example"
                                wire:model.live="visit_id"
                                id="visit_id">
                                @if ($visit->isEmpty())
                                    <option value="">Data Visit Kosong</option>
                                @else
                                    <option value="">-- Pilih Visit --</option>
                                    @foreach ($visit as $vt)
                                        <option value="{{ $vt->visit_id }}">
                                            {{ $vt->visit_id }} - {{ $vt->visit_date }} - {{ $vt->pet_id }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @error('pet_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        

                        <div class="col">
                            <div class="col mt-3">
                                <button type="submit" class="btn btn-dark btn-sm" data-bs-dismiss="modal"
                                    data-bs-target="#tambahFUVisit">
                                    <i class="fa-solid fa-plus"></i>
                                    &nbsp;Tambah F.U. Visit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm my-1 btn-secondary" data-bs-dismiss="modal"
                        data-bs-target="#tambahFUVisit" wire:click="resetInputs">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Edit FUVisit --}}
    <div wire:ignore.self class="modal fade" id="editFUVisit" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="editFUVisitLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editFUVisitLabel">EDIT F.U. Visit</h1>
                    <button type="button" class="btn-close btn-dark bg-dark" data-bs-dismiss="modal"
                        aria-label="Close" wire:click='resetInputs'></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="editFUVisit" class=''>

                        <div class="form-group col-12">
                            <label for="fu_visit_id">F.U. Visit ID</label>
                            <input wire:model='fu_visit_id' type="string" class="form-control border-2 p-2"
                                id="fu_visit_id" placeholder="" autocomplete="off" disabled>
                            @error('fu_visit_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="visit_previous">Visit Prev</label>
                            <input wire:model='visit_previous' type="string" class="form-control border-2 p-2"
                                id="visit_previous" placeholder="" autocomplete="off">
                            @error('visit_previous')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="fu_visit_action">F.U. Visit Action</label>
                            <textarea wire:model='fu_visit_action' class="form-control border-2 p-2" id="fu_visit_action" rows="3" autocomplete="off"
                            ></textarea>
                            @error('fu_visit_action')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="visit_id">Visit Ref</label>
                            <select class="form-select border-2 p-2"
                                aria-label="Default select example"
                                wire:model.live="visit_id"
                                id="visit_id">
                                @if ($visit->isEmpty())
                                    <option value="">Data Visit Kosong</option>
                                @else
                                    <option value="">-- Pilih Visit --</option>
                                    @foreach ($visit as $vt)
                                        <option value="{{ $vt->visit_id }}">
                                            {{ $vt->visit_id }} - {{ $vt->visit_date }} - {{ $vt->pet_id }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @error('pet_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col">
                            <div class="col mt-3">
                                <button type="submit" class="btn btn-warning btn-sm" data-bs-dismiss="modal"
                                    data-bs-target="#editFUVisit">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                    Edit F.U. Visit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm my-1 btn-secondary" data-bs-dismiss="modal"
                        data-bs-target="#editFUVisit" wire:click="resetInputs">Cancel</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Hapus F.U. Visit -->
    <div wire:ignore.self class="modal fade" id="hapusFUVisit" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="hapusFUVisitLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="col-12 text-center">
                        <span class="text-danger display-5" style="font-size: 120px">
                            <i class="fa-solid fa-circle-exclamation"></i>
                        </span>

                        <br />

                        <p class="text-sm">
                            Yakin Ingin Menghapus F.U. Visit<br />
                            <span class="fw-bold">
                                {{ $fu_visit_id }} - {{ $visit_previous }}
                            </span>
                        </p>
                    </div>

                    <form wire:submit.prevent="deleteFUVisit">
                        <div class="col">
                            <div class="col mt-3 text-center">
                                <button type="submit" class="btn btn-danger btn-sm" data-bs-dismiss="modal"
                                    data-bs-target="#hapusFUVisit">
                                    <i style="font-size: 15px" class="fas fa-trash" aria-hidden="true"></i>
                                    HAPUS
                                </button>

                                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal"
                                    data-bs-target="#hapusFUVisit" aria-label="Close" wire:click="resetInputs">
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
