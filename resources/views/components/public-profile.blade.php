{{-- User public profile info --}}
<div class="card">
    <div class="card-body">
        {{-- Message block --}}
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
        {{-- --- --}}
        <div class="row">
            <h2 class="card-title fs-3 col-auto">{{$user->first_name}} {{$user->last_name}}</h2>
            {{-- add / remove from favorite list --}}
            <div class="col-auto">
                @if ($user->id !== Auth::id() && $itemCount)
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
        {{-- If there are any reviews left about the user then show avg rating --}}
        
        @if (count($reviews))
            <p class="fs-5 mt-3">Lietotāja vidējais novērtējums: {{$allRatingSum / count($reviews)}} / 5</p>
        @else
            <p class="fs-5 mt-3">Par šo lietotāju pagaidām nav atstāta neviena atsauksme.</p>
        @endif
        {{-- If user doesnt have any active items in sale: --}}
        @if (!$activeItemCount)
            <p>Šim lietotājam nav aktīvu sludinājumu.</p>
        @endif
        <div class="row">
            {{-- Button to add a user review if there has been comunication between them.
                If user has left a review already, instead there is a button to edit it
            --}}
            @if (Auth::id() !== $user->id && $hasCommunicated && !$review)
                <a href="/user/{{$user->id}}/add-review" class="btn btn-success m-2 col-auto">Atstāt atsauksmi par lietotāju</a>
            @elseif (Auth::id() !== $user->id && $review)
                <a href="/user/{{$user->id}}/edit-review" class="btn btn-success m-2 col-auto">Labot atstāto atsauksmi</a>
            @endif
            {{-- Button to view user reviews if there are any--}}
            @if (count($reviews))
                <a href="/user/{{$user->id}}/all-reviews" class="btn btn-primary m-2 col-auto">Par lietotāju atstātās atsauksmes</a>
            @endif
            {{-- Button to view user ads if there are any--}}
            @if ($activeItemCount > 0)
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