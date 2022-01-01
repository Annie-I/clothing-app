{{-- The only view that logged in user with unverified email adress can see --}}
<x-app-layout>
    <x-slot name="content">
        <div class="container">
            <div class="card">
                <div class="container mt-3">
                    <h2 class="card-title fs-3 m-2">Jūsu konts ir izveidots!</h2>
                    <div class="card-body fs-5">
                        <p>
                            Lai pabeigtu reģistrāciju, lūdzu, pārbaudiet savu e-pastu un sekojiet tur norādītajām instrukcijām. 
                            Ja pēc dažām minūtēm aizvien neesat saņēmis ziņu, pieprasiet to nosūtīt atkārtoti.
                        </p>

                        @if (session('status') == 'verification-link-sent')
                            <p class="text-secondary fs-6">Uz reģistrācijā norādīto e-pasta adresi ir nosūtīta jauna ziņa ar konta aktivizēšanas instrukcijām.</p>
                        @endif

                        <form method="POST" action="{{route('verification.send')}}">
                            @csrf
                            <button type="submit" class="btn login_btn mr-3">Nosūtīt atkārtotu aktivizācijas epastu</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>
