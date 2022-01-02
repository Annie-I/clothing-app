<x-app-layout>
    <x-slot name="content">
        <div class="container">
            <div class="card">
                <div class="container mt-3">
                    <h2 class="card-title fs-3 m-2">Reģistrācija</h2>
                    <div class="card-body fs-5">
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />
                        <form method="POST" action="{{ route('register') }}" novalidate>
                            @csrf
                            <!-- First Name -->
                            <div>
                                <label for="firstName" class="form-label">Vārds</label>
                                <input id="firstName" class="form-control" type="text" name="firstName" required autofocus/>
                            </div>
                            <!-- Last Name -->
                            <div>
                                <label for="lastName" class="form-label">Uzvārds</label>
                                <input id="lastName" class="form-control" type="text" name="lastName" required/>
                            </div>
                            <!-- Birth Date -->
                            <div>
                                <label for="birthDate" class="form-label">Dzimšanas datums</label>
                                <input id="birthDate" class="form-control" type="date" name="birthDate" required />
                            </div>
                            <!-- Email Address -->
                            <div>
                                <label for="email" class="form-label">E-pasts</label>
                                <input id="email" class="form-control" type="email" name="email" required />
                            </div>
                            <!-- Password -->
                            <div>
                                <label for="password" class="form-label">Parole</label>
                                <input id="password" class="form-control"type="password" name="password" required autocomplete="new-password" />
                            </div>
                            <!-- Confirm Password -->
                            <div>
                                <label for="password_confirmation" class="form-label">Parole atkārtoti</label>
                                <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required />
                            </div>

                            <div class="row mt-4">
                                <p class="col-auto"><button type="submit" class="btn btn-success">Iesniegt</button></p>
                                <p class="col-auto"><a href="/" class="btn btn-secondary">Atcelt</a></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>