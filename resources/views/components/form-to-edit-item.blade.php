{{-- Edit item --}}
<div class="card">
    <div class="card-body fs-5">
        <h2 class="card-title fs-3 mb-3">Labot sludinājumu</h2>

        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{route('item.update', $item->id)}}" enctype="multipart/form-data" novalidate>
            @csrf
            <!-- Item Picture -->
            <div class="mb-2">
                <label for="picture" class="form-label">Pievienot bildi</label>
                <input id="picture" type="file" class="form-control" name="picture"/>
            </div>

            <!-- Item Name -->
            <div class="mb-2">
                <label for="name" class="form-label">Nosaukums</label>
                <input id="name" class="form-control" type="text" name="name" required value="{{$item->name}}"/>
            </div>

            <!-- Item Category-->
            <div class="mb-2">
                <label for="category" class="form-label">Kategorija</label>
                <select id="category" name="category" class="form-select mb-3">
                    <option value="0" disabled selected>Izvēlēties</option>
                    @foreach ($categories as $category)
                        <option value="{{$category->id}}" {{($item->category_id === $category->id) ? "selected" : ""}} >
                            {{$category->name}}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Item State -->
            <div class="mb-2">
                <p class="form-label"> Mantas stāvoklis </p>
                {{-- Get all item state id's and mark the previously selected state --}}
                @foreach ($states as $state)
                    <div class="form-check form-check-inline fs-6">
                        <input class="form-check-input" type="radio" name="state" id="state{{$state->id}}" value="{{$state->id}}"
                            {{($item->state->id === $state->id) ? "checked" : ""}} >
                        <label class="form-check-label" for="state{{$state->id}}">{{$state->name}}</label>
                    </div>
                @endforeach
            </div>

            <!-- Item Price -->
            <div class="mb-2">
                <label for="price" class="form-label"> Cena (ja vēlies preci atdot vai mainīt, cenu raksti 0)</label>
                <div class="input-group">
                    <input id="price" type="text" class="form-control" name="price" value="{{(number_format((float)($item->price), 2, '.', ''))/100}}">
                    <span class="input-group-text">€</span>
                </div>
            </div>

            <!-- Item Description -->
            <div class="mb-4">
                <label for="description" class="form-label">Apraksts</label>
                <textarea id="description" name="description" class="form-control">{{$item->description}}</textarea>
            </div>

            <!-- Buttons -->
            <button type="submit" class="btn btn-success full-width mr-3 mb-2">Saglabāt</button>
            <a href="/item/{{$item->id}}" class="btn btn-danger full-width align-top">Atcelt</a>
        </form>
    </div>
</div>