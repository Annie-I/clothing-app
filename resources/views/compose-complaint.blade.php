<x-app-layout>
    <x-slot name="content">
        <div class="container">
            <div class="row mt-10">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body fs-5">
                            <h2 class="card-title fs-3 mb-3">Nosūtīt sūdzību administrācijai</h2>
                            @if (session('message'))
                                <div class="alert alert-success">
                                    {{ session('message') }}
                                </div>
                            @endif
                            <x-auth-validation-errors class="mb-4" :errors="$errors" />
                            <form method="POST" action="{{route('complaint.send')}}" enctype="multipart/form-data" novalidate>
                                @csrf
                                {{-- Complaint subject --}}
                                <div class="mb-2">
                                    <label for="subject" class="form-label">Par ko ir sūdzība? </label>
                                    <select id="subject" name="subject" class="form-select">
                                        <option value="0" disabled selected>Izvēlēties</option>
                                        @foreach ($subjects as $subject)
                                            <option value="{{$subject->id}}">{{$subject->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Complaint Content --}}
                                <div class="mb-4">
                                    <label for="complaintContent" class="form-label">Iemesls</label>
                                    <textarea id="complaintContent" name="complaintContent" class="form-control"></textarea>
                                </div>

                                {{-- Buttons --}}
                                <button type="submit" class="btn btn-success full-width mr-3 mb-2">Nosūtīt sūdzību</button>
                                <a href="/" class="btn btn-danger full-width align-top">Atcelt</a> 
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>