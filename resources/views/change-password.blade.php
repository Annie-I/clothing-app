{{-- View to change user account password --}}
<x-app-layout>
    <x-slot name="content">
        <div class="container">
            <div class="row mt-10">
                <div class="col-12 col-md-3 mb-3">
                    <x-profile-menu/>
                </div>
                <div class="col-12 col-md-9">
                    <div class="card">
                        <div class="container mt-3">
                            <h2 class="card-title fs-3 m-2">Paroles maiņa</h2>
                            <div class="card-body fs-5">
                                {{-- Validation Errors --}}
                                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                                {{-- Messages --}}
                                @if (session('message'))
                                    <div class="alert alert-success">
                                        {{ session('message') }}
                                    </div>
                                @endif
                                @if (session('error'))
                                    <div class="alert alert-danger fs-6">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                <form method="POST" action="{{ route('password.change') }}" novalidate>
                                    @csrf
                                    {{-- Old Password --}}
                                    <div>
                                        <label for="password" class="form-label">Tagadējā parole</label>
                                        <input id="password" class="form-control" type="password" name="password"/>
                                    </div>
                                    {{-- New Password --}}
                                    <div>
                                        <label for="new_password" class="form-label">Jaunā parole</label>
                                        <input id="new_password" class="form-control" type="password" name="new_password"/>
                                    </div>
                                    {{-- Confirm New Password --}}
                                    <div>
                                        <label for="new_password_confirmation" class="form-label">Jaunā parole atkārtoti</label>
                                        <input id="new_password_confirmation" class="form-control" type="password" name="new_password_confirmation" />
                                    </div>
                                    {{-- Button --}}
                                    <div class="row mt-4">
                                        <div class="col-auto">
                                            <p><button type="submit" class="btn btn-success">Mainīt paroli</button></p>
                                        </div>
                                        <p class="col-auto"><a href="/user-information" class="btn btn-secondary">Atcelt</a></p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>