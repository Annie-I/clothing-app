{{-- Edit user info --}}
<div class="card">
    <div class="card-body fs-5">
        <h2 class="card-title fs-3">Pievienot mantu pārdošanai</h2>

        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('item.add') }}" class="row" enctype="multipart/form-data">
            @csrf
                <!-- Item Picture -->
                <div>
                    <label for="picture" class="form-label">Pievienot bildi</label>
                    <input id="picture" type="file" class="form-control" name="picture" required/>
                </div>

                <!-- Item Name -->
                <div>
                    <label for="name" class="form-label">Nosaukums</label>
                    <input id="name" class="form-control" type="text" name="name" required/>
                </div>

                <!-- Item State -->
                <div>
                    <p class="form-label"> Mantas stāvoklis </p>
                    @foreach ($states as $state)
                        <div class="form-check form-check-inline fs-6">
                            <input class="form-check-input" type="radio" name="state" id="state{{$state->id}}" value="{{$state->id}}">
                            <label class="form-check-label" for="state{{$state->id}}">{{$state->name}}</label>
                        </div>
                    @endforeach
                </div>

                <!-- Item Price -->
                <div>
                    <label for="price" class="form-label"> Cena </label>
                    <div class="input-group mb-3">
                        <input id="price" type="text" class="form-control" name="price" placeholder="ja vēlies preci atdot vai mainīt, tad šeit ieraksti 0">
                        <span class="input-group-text">€</span>
                    </div>
                </div>

                <!-- Item Description -->
                <div>
                    <label for="description" class="form-label">Apraksts</label>
                    <textarea id="description" name="description" class="form-control"></textarea>
                </div>

            <!-- Buttons -->
            <div class="container">
                <div class="row mt-3">
                    <p class="col-auto"><button type="submit" class="btn btn-success">Pievienot pārdošanai</button></p>
                    <p class="col-auto"><a href="/dashboard" class="btn btn-danger">Atcelt</a></p>
                </div>
            </div>
        </form>
    </div>
</div>