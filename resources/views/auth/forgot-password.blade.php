<x-app-layout>
    <x-slot name="content">
        <div class="container d-flex justify-content-center pt-3">
            <div class="card m-5 pl-10 pr-10">
                <div class="container mt-3">
                    <h3 class="card-title fs-4 mt-2 text-center">Atiestatīt paroli</h3>
                    <hr class="mb-1">
                    <div class="card-body fs-5">
                        <p >Ievadi savu e-pasta adresi un mēs Tev nosūtīsim paroles nomaiņas saiti!</p>
                        <!-- Session Status -->
                        <x-auth-session-status class="mb-4" :status="session('status')" />
                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />
                        <form method="POST" action="{{route('password.email')}}" novalidate>
                            @csrf
                            <!-- Email Address -->
                            <div>
                                <label for="email" class="form-label">E-pasts</label>
                                <input id="email" class="form-control" type="email" name="email" required autofocus/>
                            </div>
                            <!-- Button-->
                            <div class="d-flex justify-content-center">
                                <p class="col-auto"><button type="submit" class="btn btn-success">Saņemt ziņu</button></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>
