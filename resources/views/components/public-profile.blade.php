{{-- User public profile info --}}
@if (session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif
<div class="card">
    <div class="card-body">
        <h2 class="card-title fs-3">
        {{ $user->first_name }} {{ $user->last_name }}
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

        @if ( $user->location )
            <p class="fs-6">Atrašanās vieta: {{ $user->location }}</p>
        @endif
        <p class="fs-5 mt-3">Novērtējums: <span class="filler_text">3/5</span></p>
        <p class="fs-5 mt-2">Atsauksmes</p>
        <p class="fs-6 filler_text">Novērtējums<br/>
        Atsauksmes pievienošanas laiks + {{ $user->first_name }} {{ $user->last_name }} "pirka / pārdeva mantu"<br/>
        Autora vārds un uzvārds<br/>
            Atsauksmes saturs
        </p>
        {{-- TODO: Show user reviews --}}
        <p class="mt-3 filler_text">Šobrīd pārdošanā / Šobrīd pārdošanā nav nevienas mantas / Neesmu šeit lai pārdotu mantas</p>
        <p class="filler_text">1st item     | 2nd intem    | 3th item     | 4th item</p>
        {{-- TODO: Show items currently in sale from this person --}}
        <p><a href="#" class="btn btn-primary me-4 mt-2">Vairāk</a></p>
    </div>
</div>