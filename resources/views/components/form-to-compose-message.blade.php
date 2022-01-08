<div class="card">
    <div class="card-body fs-5">
        <h2 class="card-title fs-3 mb-3">Sūtīt ziņu lietotajam {{$user->first_name}} {{$user->last_name}}</h2>

        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{route('message.send', $user->id)}}" enctype="multipart/form-data">
            @csrf
            <!-- Message Title-->
            <div class="mb-2">
                <label for="title" class="form-label">Ziņas tēma</label>
                <input id="title" type="text" class="form-control" name="title" required/>
            </div>

            <!-- Message Content -->
            <div class="mb-4">
                <label for="content" class="form-label">Ziņas saturs</label>
                <textarea id="content" name="content" class="form-control" required></textarea>
            </div>

            <!-- Buttons -->
            <button type="submit" class="btn btn-success full-width mr-3 mb-2">Nosūtīt ziņu</button>
            <a href="{{URL::previous()}}" class="btn btn-danger full-width align-top">Atcelt</a>
        </form>
    </div>
</div>