<x-app-layout>
    <x-slot name="content">
        <div class="container d-flex justify-content-center pt-3">
            <div class="card m-5 pl-10 pr-10">
                <div class="container mt-3">
                    <h3 class="card-title fs-4 mt-2 text-center">Paroles atiestatīšana</h3>
                    <hr class="mb-1">
                    <div class="card-body fs-5">
                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />

                        <form method="POST" action="{{ route('password.update') }}" novalidate>
                            @csrf
                            <!-- Password Reset Token -->
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">
                            <!-- Email Address -->
                            <div>
                                <label for="email" class="form-label">E-pasts</label>
                                <input id="email" class="form-control" type="email" name="email" required autofocus/>
                            </div>
                            <!-- Password -->
                            <div>
                                <label for="password" class="form-label">Parole</label>
                                <input id="password" class="form-control" type="password" name="password" required/>
                            </div>
                            <!-- Confirm Password -->
                            <div>
                                <label for="password_confirmation" class="form-label">Parole atkārtoti</label>
                                <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required />
                            </div>
                            <!-- Button -->
                            <div class="d-flex justify-content-center mt-4">
                                <p><button type="submit" class="btn btn-success">Atiestatīt paroli</button></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>