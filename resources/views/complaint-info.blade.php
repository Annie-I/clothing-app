<x-app-layout>
    <x-slot name="content">
        <div class="container">
            <div class="row mt-10">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body fs-5">
                            <p class="col-auto"><a href="/new-complaint-list" class="text-decoration-none text-secondary">< Saņemto sūdzību saraksts</a></p>
                            <h2 class="card-title fw-bold fs-3 m-2">Problemātisks {{$complaint->subject->name}}</h2>
                            <p class="ml-2">Sūdzības status: <span class="fw-bold">{{$complaint->status->name}}</span></p>
                            <p class="m-2">Iesniedza: {{$complaint->user->first_name}} {{$complaint->user->last_name}}, {{$complaint->created_at}} </p>
                            <p class="m-2">{{$complaint->content}} </p>
                            <div class="row mt-5">
                                <p class="col-auto"><a href="/complaint/{{$complaint->id}}/edit" class="btn btn-primary">
                                    Mainīt sūdzības statusu</a>
                                </p>
                                <p class="col-auto"><a href="/user/{{$complaint->user->id}}/compose-message" class="btn btn-secondary">
                                    Sūtīt ziņu sūdzības iesniedzējam</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>