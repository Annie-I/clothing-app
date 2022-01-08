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
            <div class="col-auto mb-2">
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
        <div>
            @if ($user->location )
                <p class="mb-2">Atrašanās vieta: {{$user->location}}</p>
            @else
                <p class="mb-2">Atrašanās vieta nav norādīta.</p>
            @endif
        </div>

        {{-- If there are any reviews left about the user then show avg rating --}}
        <div>
            @if (count($reviews))
                <p class="fs-5 mb-4">Lietotāja vidējais novērtējums: {{$rating}} / 5</p>
            @else
                <p class="fs-5 mb-4">Par šo lietotāju pagaidām nav atstāta neviena atsauksme.</p>
            @endif
        </div>

        {{-- If user doesnt have any active items in sale: --}}
        <div>
            @if (!$activeItemCount)
                <p class="mb-4">Šim lietotājam nav aktīvu sludinājumu.</p>
            @endif
        </div>

        {{-- Buttons --}}
        {{-- Add a review if there has been comunication between them. --}}
        @if (Auth::id() !== $user->id && $hasCommunicated && !$review)
            <a href="/user/{{$user->id}}/add-review" class="btn btn-success full-width mb-2 mr-3">Atstāt atsauksmi par lietotāju</a>
        {{-- If user has left a review already, instead there is a button to edit it --}}
        @elseif (Auth::id() !== $user->id && $review)
            <a href="/user/{{$user->id}}/edit-review" class="btn btn-success full-width mb-2 mr-3">Labot atstāto atsauksmi</a>
        @endif
        {{-- Button to view user reviews if there are any--}}
        @if (count($reviews))
            <a href="/user/{{$user->id}}/all-reviews" class="btn btn-primary full-width mb-2 mr-3">Par lietotāju atstātās atsauksmes</a>
        @endif
        {{-- Button to view user ads if there are any--}}
        @if ($activeItemCount > 0)
            <a href="/user/{{$user->id}}/active-items" class="btn btn-primary full-width mb-2 mr-3">Apskatīt lietotāja sludinājumus</a>
        @endif
        {{-- Repor user --}}
        @if (!Auth::user()->is_admin && Auth::id() !== $user->id)
            <a href="/compose-complaint" class="btn btn-danger full-width mb-2 mr-3">Ziņot par pārkāpumu</a>
        @endif
        {{-- Button for admin to block the user --}}
        @if (Auth::user()->is_admin && Auth::id() !== $user->id)
            <form method="post" action="{{route('user.update.availability', $user->id)}}" class="d-inline align-top">
                @csrf
                @if (!$user->is_blocked)
                    <button type="submit" class="btn btn-danger full-width">Liegt piekļuvi sistēmai</button>
                @else
                    <button type="submit" class="btn btn-success full-width">Atjaunot piekļuvi sistēmai</button>
                @endif
            </form>
        @endif
    </div>
</div>