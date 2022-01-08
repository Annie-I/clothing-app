<x-app-layout>
    <x-slot name="content">
        <div class="container d-flex justify-content-center pt-3">
            <div class="card solo-card">
                <div class="container">
                    <div class="card-body fs-5">
                        <h2 class="card-title fs-4 mb-3 text-center">Atiestatīt paroli</h2>
                        <hr>
                        <p >Ievadi savu e-pasta adresi un mēs Tev nosūtīsim paroles nomaiņas saiti!</p>
                        <!-- Session Status -->
                        <x-auth-session-status class="mb-4" :status="session('status')" />
                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />
                        <form method="POST" action="{{route('password.email')}}" novalidate>
                            @csrf
                            <!-- Email Address -->
                            <div class="mb-4">
                                <label for="email" class="form-label">E-pasts</label>
                                <input id="email" class="form-control" type="email" name="email" required autofocus/>
                            </div>
                            <!-- Button-->
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-success full-width">Saņemt ziņu</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>
