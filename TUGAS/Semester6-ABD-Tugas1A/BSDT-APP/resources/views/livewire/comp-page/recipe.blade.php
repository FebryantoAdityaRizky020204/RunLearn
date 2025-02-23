<div class="col">
    <h5 class="mb-3 fw-bold">
        TABLE RECIPE
    </h5>
    <div class="col mb-2 bg-dark p-2 rounded-1">
        <button type="button" class="btn btn-sm text-white bg-primary mt-0 mb-0 me-4" data-bs-toggle="modal"
            data-bs-target="#tambahRecipe" id="buttonAddRecipe">
            <i class="fa-solid fa-plus"></i>
            &nbsp;Tambah Recipe
        </button>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Med</th>
                <th scope="col">Visit</th>
                <th scope="col">Dose</th>
                <th scope="col">Frekuensi</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @if (!$data->isEmpty())
                @foreach ($data as $d)
                    <tr>
                        <th scope="row">{{ $d->recipe_id }}</th>
                        <td>{{ $d->med_id }} - {{ $d->medicine->med_name }}</td>
                        <td>{{ $d->visit_id }}</td>
                        <td>{{ $d->med_dose }}</td>
                        <td>{{ $d->med_frekuensi }}</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                data-bs-target="#editRecipe" id="buttonEditRecipe"
                                wire:click='showEditRecipe({{ $d->recipe_id }})'>
                                <i class="fa-regular fa-pen-to-square"></i>
                            </button>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                data-bs-target="#hapusRecipe" id="buttonDeleteRecipe"
                                wire:click='showHapusRecipe({{ $d->recipe_id }})'>
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

    {{-- Modal Tambah Recipe --}}
    <div wire:ignore.self class="modal fade" id="tambahRecipe" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="tambahRecipeLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="tambahRecipeLabel">TAMBAH RECIPE</h1>
                    <button type="button" class="btn-close btn-dark bg-dark" data-bs-dismiss="modal" aria-label="Close"
                        wire:click='resetInputs'></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="addRecipe" class=''>

                        <div class="form-group col-12">
                            <label for="recipe_id">Recipe ID</label>
                            <input wire:model='recipe_id' type="string" class="form-control border-2 p-2"
                                id="recipe_id" placeholder="" autocomplete="off">
                            @error('recipe_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="med_id">Med</label>
                            <select class="form-select border-2 p-2"
                                aria-label="Default select example"
                                wire:model.live="med_id"
                                id="med_id">
                                @if ($med->isEmpty())
                                    <option value="">Data Med Kosong</option>
                                @else
                                    <option value="">-- Pilih Med --</option>
                                    @foreach ($med as $md)
                                        <option value="{{ $md->med_id }}">
                                            {{ $md->med_id }} - {{ $md->med_name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @error('med_id')
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
                                            {{ $vt->visit_id }} - {{ $vt->visit_date }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @error('visit_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="med_dose">Dosis</label>
                            <input wire:model='med_dose' type="string" class="form-control border-2 p-2"
                                id="med_dose" placeholder="" autocomplete="off">
                            @error('med_dose')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="med_frekuensi">Frekuensi</label>
                            <input wire:model='med_frekuensi' type="string" class="form-control border-2 p-2"
                                id="med_frekuensi" placeholder="" autocomplete="off">
                            @error('med_frekuensi')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col">
                            <div class="col mt-3">
                                <button type="submit" class="btn btn-dark btn-sm" data-bs-dismiss="modal"
                                    data-bs-target="#tambahRecipe">
                                    <i class="fa-solid fa-plus"></i>
                                    &nbsp;Tambah Recipe
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm my-1 btn-secondary" data-bs-dismiss="modal"
                        data-bs-target="#tambahRecipe" wire:click="resetInputs">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Edit Recipe --}}
    <div wire:ignore.self class="modal fade" id="editRecipe" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="editRecipeLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editRecipeLabel">EDIT RECIPE</h1>
                    <button type="button" class="btn-close btn-dark bg-dark" data-bs-dismiss="modal"
                        aria-label="Close" wire:click='resetInputs'></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="editRecipe" class=''>

                        <div class="form-group col-12">
                            <label for="recipe_id">Recipe ID</label>
                            <input wire:model='recipe_id' type="string" class="form-control border-2 p-2"
                                id="recipe_id" placeholder="" autocomplete="off">
                            @error('recipe_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="med_id">Med</label>
                            <select class="form-select border-2 p-2"
                                aria-label="Default select example"
                                wire:model.live="med_id"
                                id="med_id">
                                @if ($med->isEmpty())
                                    <option value="">Data Med Kosong</option>
                                @else
                                    <option value="">-- Pilih Med --</option>
                                    @foreach ($med as $md)
                                        <option value="{{ $md->med_id }}">
                                            {{ $md->med_id }} - {{ $md->med_name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @error('med_id')
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
                                            {{ $vt->visit_id }} - {{ $vt->visit_date }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            @error('visit_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="med_dose">Dosis</label>
                            <input wire:model='med_dose' type="string" class="form-control border-2 p-2"
                                id="med_dose" placeholder="" autocomplete="off">
                            @error('med_dose')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group col-12">
                            <label for="med_frekuensi">Frekuensi</label>
                            <input wire:model='med_frekuensi' type="string" class="form-control border-2 p-2"
                                id="med_frekuensi" placeholder="" autocomplete="off">
                            @error('med_frekuensi')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col">
                            <div class="col mt-3">
                                <button type="submit" class="btn btn-warning btn-sm" data-bs-dismiss="modal"
                                    data-bs-target="#editRecipe">
                                    <i class="fa-regular fa-pen-to-square"></i>
                                    Edit Recipe
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm my-1 btn-secondary" data-bs-dismiss="modal"
                        data-bs-target="#editRecipe" wire:click="resetInputs">Cancel</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal Hapus Recipe -->
    <div wire:ignore.self class="modal fade" id="hapusRecipe" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="hapusRecipeLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="col-12 text-center">
                        <span class="text-danger display-5" style="font-size: 120px">
                            <i class="fa-solid fa-circle-exclamation"></i>
                        </span>

                        <br />

                        <p class="text-sm">
                            Yakin Ingin Menghapus Resep<br />
                            <span class="fw-bold">
                                ID: {{ $recipe_id }}
                            </span>
                        </p>
                    </div>

                    <form wire:submit.prevent="deleteRecipe">
                        <div class="col">
                            <div class="col mt-3 text-center">
                                <button type="submit" class="btn btn-danger btn-sm" data-bs-dismiss="modal"
                                    data-bs-target="#hapusRecipe">
                                    <i style="font-size: 15px" class="fas fa-trash" aria-hidden="true"></i>
                                    HAPUS
                                </button>

                                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal"
                                    data-bs-target="#hapusRecipe" aria-label="Close" wire:click="resetInputs">
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
