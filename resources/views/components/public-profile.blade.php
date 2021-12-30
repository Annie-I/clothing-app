{{-- User public profile info --}}
@if (session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif
<div class="card">
    <div class="card-body">
        <div class="row">
            <h2 class="card-title fs-3 col-auto">{{$user->first_name}} {{$user->last_name}}</h2>
            {{-- add / remove from favorite list --}}
            <div class="col-auto">
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
            </div>
        </div>
        {{-- User location --}}
        <div class="col-auto">
            @if ($user->location )
                <p>Atrašanās vieta: {{$user->location}}</p>
            @else
                <p>Atrašanās vieta nav norādīta.</p>
            @endif
        </div>
        <p class="fs-5 mt-3">Lietotāja vidējais novērtējums: <span class="filler_text">3/5</span></p>
        @if (!$itemCount)
            <p>Šim lietotājam nav aktīvu sludinājumu.</p>
        @endif
        <div class="row">
            {{-- Button to add a user review if there has been comunication between them.
                If user has left a review already, instead there is a button to edit it
            --}}
            @if (Auth::id() !== $user->id && $hasCommunicated && !$hasReviewed)
                <a href="/user/{{$user->id}}/add-review" class="btn btn-success m-2 col-auto">Atstāt atsauksmi par lietotāju</a>
            @elseif ($hasReviewed && Auth::id() !== $user->id)
                <a href="/user/{{$user->id}}/edit-review" class="btn btn-success m-2 col-auto">Labot atstāto atsauksmi</a>
            @endif
            {{-- Button to view user reviews if there are any--}}
            <a href="#" class="btn btn-primary m-2 col-auto">Par lietotāju atstātās atsauksmes</a>
            {{-- Button to view user ads if there are any--}}
            @if ($itemCount > 0)
                <a href="/user/{{$user->id}}/active-items" class="btn btn-primary m-2 col-auto">Apskatīt lietotāja sludinājumus</a>
            @endif
            {{-- Button for admin to block the user --}}
            @if (Auth::user()->is_admin && Auth::id() !== $user->id)
                <form method="post" action="{{route('user.block', $user->id)}}" class="col-auto">
                    @csrf
                    <button type="submit" class="btn btn-danger">Bloķēt lietotāju</p>
                </form>
            @endif
        </div>
    </div>
</div>