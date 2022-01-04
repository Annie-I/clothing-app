<x-app-layout>
    <x-slot name="content">
        <div class="container">
            <div class="row mt-10">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body fs-5">
                            <h2 class="card-title fw-bold fs-3 m-2">Problemātisks {{$complaint->subject->name}}</h2>
                            <p class="ml-2">Sūdzības statuss: <span class="fw-bold">{{$complaint->status->name}}</span></p>
                            <p class="m-2">Iesniedza: {{$complaint->user->first_name}} {{$complaint->user->last_name}}, {{$complaint->created_at}} </p>
                            <p class="m-2">{{$complaint->content}} </p>
                            <x-auth-validation-errors class="mb-4" :errors="$errors" />
                            <form method="POST" action="{{route('complaint.status.update', $complaint)}}" class="row" enctype="multipart/form-data">
                                @csrf
                                <!-- Complaint status-->
                                <div>
                                    <label for="status" class="form-label">Statuss</label>
                                    <select id="status" name="status" class="form-select mb-3">
                                        @foreach ($statuses as $status)
                                            <option value="{{$status->id}}" {{($complaint->status_id === $status->id) ? "selected" : ""}} required>
                                                {{$status->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- Admin comments -->
                                <div>
                                    <label for="comment" class="form-label">Piezīmes</label>
                                    <textarea id="comment" name="comment" class="form-control">{{$complaint->status_notes}}</textarea>
                                </div>
                                <!-- Buttons -->
                                <div class="container">
                                    <div class="row mt-3">
                                        <p class="col-auto"><button type="submit" class="btn btn-success">Mainīt statusu</button></p>
                                        <p class="col-auto"><a href="/complaint/{{$complaint->id}}/view" class="btn btn-danger">Atcelt</a></p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>