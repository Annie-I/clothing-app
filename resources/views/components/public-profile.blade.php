{{-- User public profile info --}}
@if (session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif
<div class="card">
    <div class="card-body">
        <h2 class="card-title fs-3">
        {{$user->first_name}} {{$user->last_name}}
        {{-- add / remove from favorite list --}}
            @if ($user->id !== Auth::id() )
                @if ($isFavorited)
                    <form action="/user/{{$user->id}}/remove-from-favorites" method="post">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger">- Dzēst favorītu</button>
                    </form>
                @else
                    <form action="/user/{{$user->id}}/add-to-favorites" method="post">
                        @csrf
                        <button type="submit" class="btn btn-outline-primary">+ Pievienot favorītiem</button>
                    </form>
                @endif
            @endif
        </h2>
        {{-- User location --}}
        @if ($user->location )
            <p class="fs-6">Atrašanās vieta: {{ $user->location }}</p>
        @endif
        {{-- Button to view user ads if there are any--}}
        @if ($itemCount > 0)
            <p><a href="/user/{{$user->id}}/active-items" class="btn btn-primary me-4 mt-2">Lietotāja sludinājumi</a></p>
        @else
            <p class="">Šim lietotājam nav aktīvu sludinājumu.</p>
        @endif
        <p class="fs-5 mt-3">Vidējais novērtējums: <span class="filler_text">3/5</span></p>
        {{-- Button to view user reviews if there are any--}}
        <p><a href="#" class="btn btn-primary me-4">Par lietotāju atstātās atsauksmes</a></p>
        @if (Auth::user()->is_admin)
            <form method="post" action="{{route('user.block', $user->id)}}">
                @csrf
                <button type="submit" class="btn btn-danger">Bloķēt lietotāju</p>
            </form>
        @endif
    </div>
</div>