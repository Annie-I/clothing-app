<x-app-layout>
    <x-slot name="content">
        <div class="container">
            <div class="row mt-10">
                <div class="col-12 col-md-3 mb-3">
                    <x-profile-menu/>
                </div>
                <div class="col-12 col-md-9">
                    <div class="card">
                        <div class="card-body">
                            <p class="fs-3 m-2">Bloķēto lietotāju saraksts</p>
                            @if (session('message'))
                                <div class="alert alert-success">
                                    {{ session('message') }}
                                </div>
                            @endif
                            <div class="row">
                                @if (count($blockedUsers) === 0)
                                    <p class="m-2">Šobrīd nav neviena bloķēta lietotāja.</p>
                                @endif
                                @foreach ($blockedUsers as $user)
                                    <div class="col-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <a href="/user/{{$user->id}}" class="card-title text-truncate fw-bold fs-5">{{$user->first_name}} {{$user->last_name}}</a>
                                                {{-- <h5 class="card-title text-truncate">{{$user->first_name}} {{$user->last_name}}</h5> --}}
                                                    {{-- <a href="/user/{{$user->id}}" class="col-6 btn btn-primary">Atvērt profilu</a> --}}
                                                        <form method="post" class="d-flex justify-content-center mt-3" action="{{route('user.update.availability', $user->id)}}">
                                                            @csrf
                                                            <button type="submit" class="btn btn-success">Atjaunot piekļuvi</p>
                                                        </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>