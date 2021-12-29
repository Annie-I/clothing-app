<x-app-layout>
    <x-slot name="content">
        <div class="container">
            <div class="row mt-10">
                <div class="col-12 col-md-3 mb-3">
                    <x-admin-profile-menu/>
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
                                                <h5 class="card-title text-truncate">{{$user->first_name}} {{$user->last_name}}</h5>
                                                <div class="row">
                                                    <a href="/user/{{$user->id}}" class="col-auto btn btn-primary">Atvērt profilu</a>
                                                    <div class="col-auto">
                                                        <form method="post" action="{{route('user.unblock', $user->id)}}">
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger">Atbloķēt</p>
                                                        </form>
                                                    </div>
                                                </div>
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