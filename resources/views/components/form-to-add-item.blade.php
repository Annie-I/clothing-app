{{-- Edit user info --}}
<div class="card">
    <div class="card-body fs-5">
        <h2 class="card-title fs-3">Pievienot mantu pārdošanai</h2>

        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('item.add') }}" class="row" enctype="multipart/form-data">
            @csrf
                <!-- Item Picture -->
                <div>
                    <label for="itemPicture" class="form-label">Pievienot bildi</label>
                    <input id="itemPicture" type="file" class="form-control" name="itemPicture" required/>
                </div>

                <!-- Item Name -->
                <div>
                    <label for="itemName" class="form-label">Nosaukums</label>
                    <input id="itemName" class="form-control" type="text" name="itemName" required/>
                </div>

                <!-- Item State -->
                <div>
                    <p class="form-label"> Mantas stāvoklis </p>
                    @foreach ($states as $state)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="itemState" id="itemState1" value="{{$state->id}}">
                            <label class="form-check-label" for="itemState1">{{$state->name}}</label>
                        </div>
                    @endforeach
                </div>

                <!-- Item Cost -->
                <div>
                    <label for="itemCost" class="form-label"> Cena </label>
                    <div class="input-group mb-3">
                        <input id="itemCost" type="text" class="form-control" placeholder="ja vēlies preci atdot vai mainīt, tad šeit ieraksti 0">
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
                    <p class="col-auto"><a href="/dashboard" class="btn btn-secondary">Atcelt</a></p>
                </div>
            </div>
        </form>
    </div>
</div>