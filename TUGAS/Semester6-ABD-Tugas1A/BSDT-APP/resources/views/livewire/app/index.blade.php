@section('title')
Administrasi Basis Data - APP
@endsection

<div class="row g-2">
    <div class="col-2 mt-0">
        <div class="d-flex flex-column flex-shrink-0 p-1 pt-3 mx-3 mt-2 rounded sticky-top">

            {{-- <span class="badge text-bg-dark rounded-0 py-1 my-2">
                PROCESSS
            </span>
            <ul class="nav nav-pills flex-column mb-auto">
                <li><a href="javascript:void(0)" wire:click="changePage('clinics')"
                        class="nav-link link-body-emphasis {{ $page == 'clinics' ? 'active text-white fw-bold' : '' }}">
                        <i class="fa-solid fa-house-chimney-medical"></i> &nbsp;
                        Clinics
                    </a>
                </li>

                <li><a href="javascript:void(0)" wire:click="changePage('patient')"
                        class="nav-link link-body-emphasis {{ $page == 'patient' ? 'active text-white fw-bold' : '' }}">
                        <i class="fa-solid fa-hospital-user"></i> &nbsp;
                        Patient
                    </a>
                </li>

                <li><a href="javascript:void(0)" wire:click="changePage('clinic-visit')"
                        class="nav-link link-body-emphasis {{ $page == 'clinic-visit' ? 'active text-white fw-bold' : '' }}">
                        <i class="fa-solid fa-notes-medical"></i> &nbsp;
                        Clinic Visit
                    </a>
                </li>
            </ul> --}}

            <span class="badge text-bg-dark rounded-0 py-1 my-2">
                TABLES
            </span>
            <ul class="nav nav-pills flex-column mb-auto">
                <li><a href="javascript:void(0)" wire:click="changePage('clinic')"
                        class="nav-link link-body-emphasis {{ $page == 'clinic' ? 'active text-white fw-bold' : '' }}">Clinic</a>
                </li>
                <li><a href="javascript:void(0)" wire:click="changePage('medicine')"
                        class="nav-link link-body-emphasis {{ $page == 'medicine' ? 'active text-white fw-bold' : '' }}">Medicine</a>
                </li>
                <li><a href="javascript:void(0)" wire:click="changePage('pawrent')"
                        class="nav-link link-body-emphasis {{ $page == 'pawrent' ? 'active text-white fw-bold' : '' }}">Pawrent
                        - Pet</a>
                </li>
                {{-- <li><a href="javascript:void(0)" wire:click="changePage('pet')"
                        class="nav-link link-body-emphasis {{ $page == 'pet' ? 'active text-white fw-bold' : '' }}">Pet</a>
                </li> --}}
                <li><a href="javascript:void(0)" wire:click="changePage('veterinarian')"
                        class="nav-link link-body-emphasis {{ $page == 'veterinarian' ? 'active text-white fw-bold' : '' }}">Veterinarian</a>
                </li>
                <li><a href="javascript:void(0)" wire:click="changePage('veterinarianspecialist')"
                        class="nav-link link-body-emphasis {{ $page == 'veterinarianspecialist' ? 'active text-white fw-bold' : '' }}">VeterinarianSpecialist</a>
                </li>
                <li><a href="javascript:void(0)" wire:click="changePage('visit')"
                        class="nav-link link-body-emphasis {{ $page == 'visit' ? 'active text-white fw-bold' : '' }}">Visit</a>
                </li>
                <li><a href="javascript:void(0)" wire:click="changePage('followupvisit')"
                        class="nav-link link-body-emphasis {{ $page == 'followupvisit' ? 'active text-white fw-bold' : '' }}">Follow
                        Up Visit</a>
                </li>
                <li><a href="javascript:void(0)" wire:click="changePage('recipe')"
                        class="nav-link link-body-emphasis {{ $page == 'recipe' ? 'active text-white fw-bold' : '' }}">Recipe</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="col-10">
        <div class="row min-vh-100 py-3" id="home">
            @if ($page == 'home')
                <h3 class="text-primary fw-bold">Halaman Home</h3>
            @elseif ($page == 'clinic')
                <livewire:clinic-livewire>
            @elseif ($page == 'medicine')
                <livewire:medicine-livewire>
            @elseif ($page == 'pawrent')
                <livewire:pawrent-livewire>
            @elseif ($page == 'recipe')
                <livewire:recipe-livewire>
            @elseif ($page == 'followupvisit')
                <livewire:follow-up-visit-livewire>
            @elseif ($page == 'veterinarian')
                <livewire:veterinarian-livewire>
            @elseif ($page == 'veterinarianspecialist')
                <livewire:veterinarian-specialist-livewire>
            @elseif ($page == 'visit')
                <livewire:visit-livewire>
            @elseif ($page == 'clinics')
                <livewire:clinics-livewire>
            @elseif ($page == 'patient')
                <livewire:patient-livewire>
            @elseif ($page == 'clinic-visit')
                <livewire:clinic-visit-livewire>
            @else
                <h3 class="text-primary fw-bold">Something ///</h3>
            @endif
        </div>

        {{-- <div class="row min-vh-100 py-3" id="clinic">
        </div> --}}

    </div>
</div>