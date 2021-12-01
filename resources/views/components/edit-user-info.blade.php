{{-- Edit user info --}}
<div class="card">
    <div class="card-body fs-5">


        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        {{-- <form method="POST" action="{{ route('eddit user data') }}"> --}}
            @csrf

            <!-- First Name -->
            <div>
                <x-label for="firstName" :value="__('Vārds')" />

                <x-input id="firstName" class="block mt-1 w-full" type="text" name="firstName" :value="old('firstName')" required autofocus />
            </div>

            
            <!-- Last Name -->
            <div class="mt-4">
                <x-label for="lastName" :value="__('Uzvārds')" />

                <x-input id="lastName" class="block mt-1 w-full" type="text" name="lastName" :value="old('lastName')" required />
            </div>

            <!-- Birth Date -->
            <div class="mt-4">
                <x-label for="birthDate" :value="__('Dzimšanas datums')" />

                <x-input id="birthDate" class="block mt-1 w-full" type="date" name="birthDate" :value="old('birthDate')" required />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('E-pasts')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>



        <p class="fs-3 m-2">Labot manus datus</p>
        <div class="m-2">
            <p class="mb-2">Vārds: <span class="fw-bold">{{ $user->first_name }}</span></p>
            <p class="mb-2">Uzvārds: <span class="fw-bold">{{ $user->last_name }}</span></p>
            <p class="mb-2">Dzimšanas datums: <span class="fw-bold">{{ $user->birth_date}}</span></p>
            @if ( $user->location )
                <p class="mb-2">Atrodašanās vieta: <span class="fw-bold">{{ $user->location }}</span></p>
            @else
                <p class="mb-2">Atrašanās vieta: <span class="fw-bold">nav norādīta</span></p>
            @endif
            <p class="mb-4">E-pasts: <span class="fw-bold">{{ $user->email }}</span></p>
            <div class="container mb-2">
                <div class="row">
                    <p class="col-2"><a href="#" class="btn btn-success">Saglabāt</a></p>
                    <p class="col-2"><a href="/user-information" class="btn btn-secondary">Atcelt izmaiņas</a></p>
                </div>
            </div>
        </div>




    </div>
</div>