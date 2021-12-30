<div class="card">
    <div class="card-body fs-5">
        <h2 class="card-title fs-3">Labot atstāto atsauksmi par lietotāju {{$user->first_name}} {{$user->last_name}}</h2>

        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{route('review.edit', $user)}}" enctype="multipart/form-data">
            @csrf
            <!-- Rating-->
            <p class="form-label ml-2 mt-4"> Kā Jūs vērtētu sadarbību ar šo lietotāju? (0 - ļoti slikti, 5 - izcili) </p>
            @for ($n = 0; $n <= 5; $n++)
                <div class="form-check form-check-inline ml-2 fs-6">
                    <input class="form-check-input" type="radio" name="rating" id="rating{{$n}}" value="{{$n}}" required
                    {{($review->rating === $n) ? "checked" : ""}}
                    >
                    <label class="form-check-label" for="rating{{$n}}">{{$n}}</label>
                </div>
            @endfor

            <!-- Review -->
            <div class="m-2">
                <label for="review" class="form-label">Atsauksme</label>
                <textarea id="review" name="review" class="form-control" required>{{$review->review}}</textarea>
            </div>

            <!-- Buttons -->
            <div class="row mt-3">
                <p class="col-auto ml-2"><button type="submit" class="btn btn-success">Labot atsauksmi</button></p>
                <p class="col-auto"><a href="/user/{{$user->id}}" class="btn btn-danger">Atcelt</a></p>
            </div>
        </form>
    </div>
</div>