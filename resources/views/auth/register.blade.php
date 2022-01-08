<x-app-layout>
    <x-slot name="content">
        <div class="container d-flex justify-content-center">
            <div class="card solo-card">
                <div class="container">
                    <div class="card-body fs-5">
                        <h2 class="card-title fs-4 text-center">Reģistrācija</h2>
                        <hr>
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />
                        <form method="POST" action="{{ route('register') }}" novalidate>
                            @csrf
                            {{-- First Name --}}
                            <div class="mb-2">
                                <label for="firstName" class="form-label">Vārds</label>
                                <input id="firstName" class="form-control" type="text" name="firstName" required autofocus/>
                            </div>
                            {{-- Last Name --}}
                            <div class="mb-2">
                                <label for="lastName" class="form-label">Uzvārds</label>
                                <input id="lastName" class="form-control" type="text" name="lastName" required/>
                            </div>
                            {{-- Birth Date --}}
                            <div class="mb-2">
                                <label for="birthDate" class="form-label">Dzimšanas datums</label>
                                <input id="birthDate" class="form-control" type="date" name="birthDate" required />
                            </div>
                            {{-- Email Address --}}
                            <div class="mb-2">
                                <label for="email" class="form-label">E-pasts</label>
                                <input id="email" class="form-control" type="email" name="email" required />
                            </div>
                            {{-- Password --}}
                            <div class="mb-2">
                                <label for="password" class="form-label">Parole</label>
                                <input id="password" class="form-control"type="password" name="password" required autocomplete="new-password" />
                            </div>
                            {{-- Confirm Password --}}
                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label">Parole atkārtoti</label>
                                <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required />
                            </div>

                            {{-- Buttons --}}
                            <button type="submit" class="btn btn-success full-width mr-3 mb-2">Iesniegt</button>
                            <a href="/" class="btn btn-secondary full-width align-top">Atcelt</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>