<div class="card">
    <div class="card-body fs-5">
        <div class="row">
            <h2 class="card-title fs-3 mb-2 col-auto">Labot atstāto atsauksmi par lietotāju {{$user->first_name}} {{$user->last_name}}</h2>

            {{-- Delete button --}}
            <div class="col-auto mb-3">
                <form method="post" action="{{route('review.delete', $review)}}">
                    @csrf
                    <button type="submit" class="btn btn-danger full-width">Dzēst atsauksmi</button>
                </form>
            </div>
        </div>

        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{route('review.edit', $user)}}" enctype="multipart/form-data" novalidate>
            @csrf
            {{-- Rating --}}
            <p class="form-label mb-2"> Kā Jūs vērtētu sadarbību ar šo lietotāju? (0 - ļoti slikti, 5 - izcili)</p>
            @for ($n = 0; $n <= 5; $n++)
                <div class="form-check form-check-inline fs-6">
                    <input class="form-check-input" type="radio" name="rating" id="rating{{$n}}" value="{{$n}}"
                    {{($review->rating === $n) ? "checked" : ""}}
                    >
                    <label class="form-check-label" for="rating{{$n}}">{{$n}}</label>
                </div>
            @endfor
            {{-- Review --}}
            <div class="mb-4">
                <label for="review" class="form-label">Atsauksme</label>
                <textarea id="review" name="review" class="form-control">{{$review->review}}</textarea>
            </div>

            {{-- Buttons --}}
            <button type="submit" class="btn btn-success full-width mr-3 mb-2">Labot atsauksmi</button>
            <a href="/user/{{$user->id}}" class="btn btn-secondary full-width align-top mb-2">Atcelt</a>
        </form>
    </div>
</div>