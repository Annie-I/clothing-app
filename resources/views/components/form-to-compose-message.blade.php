<div class="card">
    <div class="card-body fs-5">
        <h2 class="card-title fs-3">Sūtīt ziņu lietotajam {{$user->first_name}} {{$user->last_name}}</h2>

        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{route('message.send', $user->id)}}" class="row" enctype="multipart/form-data">
            @csrf
                <!-- Message Title-->
                <div>
                    <label for="title" class="form-label">Ziņas tēma</label>
                    <input id="title" type="text" class="form-control" name="title" required/>
                </div>

                <!-- Message Content -->
                <div>
                    <label for="content" class="form-label">Ziņas saturs</label>
                    <textarea id="content" name="content" class="form-control" required></textarea>
                </div>

                <!-- Buttons -->
                <div class="container">
                    <div class="row mt-3">
                        <p class="col-auto"><button type="submit" class="btn btn-success">Nosūtīt ziņu</button></p>
                        <p class="col-auto"><a href="{{URL::previous()}}" class="btn btn-danger">Atcelt</a></p>
                    </div>
                </div>
        </form>
    </div>
</div>