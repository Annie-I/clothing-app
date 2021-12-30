<x-app-layout>
    <x-slot name="content">
        <div class="container">
            <div class="row mt-10">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body fs-5">
                            <h2 class="card-title fs-3">Nosūtīt sūdzību administrācijai</h2>
                            @if (session('message'))
                                <div class="alert alert-success">
                                    {{ session('message') }}
                                </div>
                            @endif
                            <x-auth-validation-errors class="mb-4" :errors="$errors" />
                            <form method="POST" action="{{route('complaint.send')}}" class="row" enctype="multipart/form-data" >
                                @csrf
                                <!-- Complaint subject-->
                                <div>
                                    <label for="subject" class="form-label">Problēmas sagādā:</label>
                                    <select id="subject" name="subject" class="form-select mb-3">
                                        <option value="0" disabled selected>Izvēlēties</option>
                                        @foreach ($subjects as $subject)
                                            <option value="{{$subject->id}}" required>{{$subject->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Complaint Content -->
                                <div>
                                    <label for="content" class="form-label">Sūdzības iemesls</label>
                                    <textarea id="content" name="content" class="form-control" required></textarea>
                                </div>

                                <!-- Buttons -->
                                <div class="container">
                                    <div class="row mt-3">
                                        <p class="col-auto"><button type="submit" class="btn btn-success">Nosūtīt Sūdzību</button></p>
                                        <p class="col-auto"><a href="{{URL::previous()}}" class="btn btn-danger">Atcelt</a></p>
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