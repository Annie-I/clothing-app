{{-- Add item to sale--}}

<div class="card">
    <div class="card-body fs-5">
        <h2 class="card-title fs-3 mb-3">Pievienot mantu pārdošanai</h2>

        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('item.add') }}" enctype="multipart/form-data" novalidate>
            @csrf
            <!-- Item Picture -->
            <div class="mb-2">
                <label for="picture" class="form-label">Pievienot bildi</label>
                <input id="picture" type="file" class="form-control" name="picture"/>
            </div>

            <!-- Item Name -->
            <div class="mb-2">
                <label for="name" class="form-label">Nosaukums</label>
                <input id="name" class="form-control" type="text" name="name"/>
            </div>

            <!-- Item category-->
            <div class="mb-2">
                <label for="category" class="form-label">Kategorija</label>
                <select id="category" name="category" class="form-select mb-3">
                    <option value="0" disabled selected>Izvēlēties</option>
                    @foreach ($categories as $category)
                        <option value="{{$category->id}}">
                            {{$category->name}}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Item State -->
            <div class="mb-2">
                <p class="form-label"> Mantas stāvoklis </p>
                @foreach ($states as $state)
                    <div class="form-check form-check-inline fs-6">
                        <input class="form-check-input" type="radio" name="state" id="state{{$state->id}}" value="{{$state->id}}">
                        <label class="form-check-label" for="state{{$state->id}}">{{$state->name}}</label>
                    </div>
                @endforeach
            </div>

            <!-- Item Price -->
            <div class="mb-2">
                <label for="price" class="form-label"> Cena </label>
                <div class="input-group">
                    <input id="price" type="text" class="form-control" name="price" placeholder="ja vēlies preci atdot vai mainīt, tad šeit ieraksti 0">
                    <span class="input-group-text">€</span>
                </div>
            </div>

            <!-- Item Description -->
            <div class="mb-4">
                <label for="description" class="form-label">Apraksts</label>
                <textarea id="description" name="description" class="form-control"></textarea>
            </div>

            <!-- Buttons -->
            <div>
                <button type="submit" class="btn btn-success full-width mr-3 mb-2">Pievienot pārdošanai</button>
                <a href="/dashboard" class="btn btn-secondary full-width align-top">Atcelt</a>
            </div>
        </form>
    </div>
</div>