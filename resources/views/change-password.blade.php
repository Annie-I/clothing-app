{{-- View to change user account password --}}
<x-app-layout>
    <x-slot name="content">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-3 mb-3">
                    <x-profile-menu/>
                </div>
                <div class="col-12 col-md-9">
                    <div class="card">
                        <div class="card-body fs-5">
                            <h2 class="card-title fs-3 mb-3">Paroles maiņa</h2>
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
                                <div class="mb-2">
                                    <label for="password" class="form-label">Tagadējā parole</label>
                                    <input id="password" class="form-control" type="password" name="password"/>
                                </div>
                                {{-- New Password --}}
                                <div class="mb-2">
                                    <label for="new_password" class="form-label">Jaunā parole</label>
                                    <input id="new_password" class="form-control" type="password" name="new_password"/>
                                </div>
                                {{-- Confirm New Password --}}
                                <div class="mb-4">
                                    <label for="new_password_confirmation" class="form-label">Jaunā parole atkārtoti</label>
                                    <input id="new_password_confirmation" class="form-control" type="password" name="new_password_confirmation" />
                                </div>
                                {{-- Button --}}
                                <button type="submit" class="btn btn-success full-width mr-3 mb-2">Mainīt paroli</button>
                                <a href="/user-information" class="btn btn-secondary full-width align-top">Atcelt</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>