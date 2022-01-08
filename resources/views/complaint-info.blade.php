<x-app-layout>
    <x-slot name="content">
        <div class="container">
            <div class="row mt-10">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body fs-5">
                            <p><a href="/new-complaint-list" class="text-decoration-none text-secondary">< Saņemto sūdzību saraksts</a></p>
                            <h2 class="card-title fw-bold fs-3 mb-3">Problemātisks {{$complaint->subject->name}}</h2>
                            <p class="mb-2">Sūdzības statuss: <span class="fw-bold">{{$complaint->status->name}}</span></p>
                            <p class="mb-2">Iesniedza: {{$complaint->user->first_name}} {{$complaint->user->last_name}}, {{$complaint->created_at}} </p>
                            <p class="mb-4">{{$complaint->content}} </p>
                            <a href="/complaint/{{$complaint->id}}/edit" class="btn btn-primary full-width mb-2 mr-3">Mainīt sūdzības statusu</a>
                            <a href="/user/{{$complaint->user->id}}/compose-message" class="btn btn-secondary full-width align-top">Sūtīt ziņu sūdzības iesniedzējam</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>