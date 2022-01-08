{{-- View to edit user information --}}
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
                            <h2 class="card-title fs-3 mb-3">Labot manus datus</h2>
                    
                            <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    
                            <form method="POST" action="{{ route('user.info.edit') }}" novalidate>
                                @csrf
                                <div class="row mb-2">
                                    {{-- First Name --}}
                                    <div class="col-12 col-md-6">
                                        <label for="firstName" class="form-label">Vārds</label>
                                        <input id="firstName" class=" form-control" type="text" name="firstName" value="{{$user->first_name}}"/>
                                    </div>
                                    {{-- Last Name --}}
                                    <div class="col-12 col-md-6">
                                        <label for="lastName" class="form-label">Uzvārds</label>
                                        <input id="lastName" class="form-control" type="text" name="lastName" value="{{$user->last_name}}"/>
                                    </div>
                                </div>
                                {{-- Birth Date --}}
                                <div class="mb-2">
                                    <label for="birthDate" class="form-label">Dzimšanas datums</label>
                                    <input id="birthDate" class="form-control" type="date" name="birthDate" value="{{$user->birth_date}}"/>
                                </div>
                                {{-- Location --}}
                                <div class="mb-4">
                                    <label for="location" class="form-label">Atrašanās vieta (būs redzama sludinājumos un profilā)</label>
                                    <input id="location" class="form-control" type="text" name="location" value="{{$user->location}}"/>
                                </div>
                    
                                {{-- Buttons --}}
                                <button type="submit" class="btn btn-success mr-3 mb-2 full-width">Saglabāt</button>
                                <a href="/user-information" class="btn btn-secondary full-width align-top">Atcelt izmaiņas</a>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </x-slot>
</x-app-layout>