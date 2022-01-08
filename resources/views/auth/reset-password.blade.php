<x-app-layout>
    <x-slot name="content">
        <div class="container d-flex justify-content-center">
            <div class="card solo-card">
                <div class="container">
                    <div class="card-body fs-5">
                        <h2 class="card-title fs-4 mb-3 text-center">Paroles atiestatīšana</h2>
                        <hr>
                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />
    
                        <form method="POST" action="{{ route('password.update') }}" novalidate>
                            @csrf
                            <!-- Password Reset Token -->
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">
                            <!-- Email Address -->
                            <div class="mb-2">
                                <label for="email" class="form-label">E-pasts</label>
                                <input id="email" class="form-control" type="email" name="email" required autofocus/>
                            </div>
                            <!-- Password -->
                            <div class="mb-2">
                                <label for="password" class="form-label">Parole</label>
                                <input id="password" class="form-control" type="password" name="password" required/>
                            </div>
                            <!-- Confirm Password -->
                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label">Parole atkārtoti</label>
                                <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required />
                            </div>
                            <!-- Button -->
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-success full-width">Atiestatīt paroli</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>