{{-- View to edit user information --}}
<x-app-layout>
    <x-slot name="content">
        <div class="container">
            <div class="row mt-10">
                <div class="col-12 col-md-3 mb-3">
                    <x-profile-menu/>
                </div>
                <div class="col-12 col-md-9">
                    <div class="card">
                        <div class="card-body fs-5">
                            <h2 class="card-title fs-3">Labot manus datus</h2>
                    
                            <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    
                            <form method="POST" action="{{ route('user.info.edit') }}" class="row" novalidate>
                                @csrf
                                <div class="row">
                                    <!-- First Name -->
                                    <div class="col">
                                        <label for="firstName" class="form-label">Vārds</label>
                                        <input id="firstName" class=" form-control" type="text" name="firstName" value="{{$user->first_name}}"/>
                                    </div>
                                    <!-- Last Name -->
                                    <div class="col">
                                        <label for="lastName" class="form-label">Uzvārds</label>
                                        <input id="lastName" class="form-control" type="text" name="lastName" value="{{$user->last_name}}"/>
                                    </div>
                                </div>
                                <!-- Birth Date -->
                                <div class="row">
                                    <div>
                                        <label for="birthDate" class="form-label">Dzimšanas datums</label>
                                        <input id="birthDate" class="form-control" type="date" name="birthDate" value="{{$user->birth_date}}"/>
                                    </div>
                                    <!-- Location -->
                                    <div>
                                        <label for="location" class="form-label">Atrašanās vieta (būs redzama sludinājumos un profilā)</label>
                                        <input id="location" class="form-control" type="text" name="location" value="{{$user->location}}"/>
                                    </div>
                                </div>
                    
                                <!-- Buttons -->
                                <div class="container">
                                    <div class="row mt-3">
                                        <p class="col-auto"><button type="submit" class="btn btn-success">Saglabāt</button></p>
                                        <p class="col-auto"><a href="/user-information" class="btn btn-secondary">Atcelt izmaiņas</a></p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </x-slot>
</x-app-layout>