<x-app-layout>
    <x-slot name="content">
        <div class="container d-flex justify-content-center pt-3">
            <div class="card m-5 pl-10 pr-10">
                <div class="container mt-3">
                    <h3 class="card-title fs-4 mt-2 text-center">Pieteikties sistēmā</h3>
                    <hr class="mb-1">
                    <div class="card-body fs-5">
                        <!-- Session Status -->
                        <x-auth-session-status class="mb-4" :status="session('status')"/>
                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />

                        <form method="POST" action="{{route('login')}}" >
                            @csrf
                            <!-- Email Address -->
                            <div>
                                <label for="email" class="form-label">E-pasts</label>
                                <input id="email" class="form-control" type="email" name="email" required autofocus/>
                            </div>
                            <!-- Password -->
                            <div>
                                <label for="password" class="form-label">Parole</label>
                                <input id="password" class="form-control"type="password" name="password" required autocomplete="current-password"/>
                            </div>
                            <!-- Remember Me -->
                            <div>
                                <label for="remember_me" class="inline-flex items-center">
                                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                                    <span class="ml-2 text-sm text-gray-600">{{ __('Atcerēties mani') }}</span>
                                </label>
                            </div>
                            <!-- Buttons -->
                            <div class="row mt-4">
                                <div class="col-auto">
                                    <p class="col-auto"><button type="submit" class="btn btn-success">Pieteikties</button></p>
                                </div>
                                <div class="col-auto">
                                    @if (Route::has('password.request'))
                                        <a href="{{route('password.request')}}" class="btn btn-link link-secondary text-decoration-none me-2">Aizmirsi paroli?</a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>