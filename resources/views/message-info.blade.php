<x-app-layout>
    <x-slot name="content">
        <div class="container">
            <div class="row mt-10">
                <div class="col-12 col-md-3 mb-3">
                    <x-profile-menu/>
                </div>
                <div class="col-12 col-md-9">
                    <div class="card">
                        <div class="card-body fs-5">
                            <p class="col-auto"><a href="{{URL::previous()}}" class="text-decoration-none text-secondary">< Atpakaļ</a></p>
                            <h2 class="card-title fw-bold fs-3 mb-3">{{$message->title}}</h2>
                            @if (Auth::user()->id === $message->receiver_id)
                                <p class="mb-2">Nosūtīja: {{$message->sender->first_name}} {{$message->sender->last_name}}, {{$message->created_at}} </p>
                            @else
                                <p class="mb-2">Saņemējs: {{$message->receiver->first_name}} {{$message->receiver->last_name}}, {{$message->created_at}} </p>
                            @endif
                            <p class="mb-4">{{$message->content}}</p>

                                @if (Auth::user()->id === $message->receiver_id)
                                    <a href="/user/{{$message->sender_id}}/compose-message" class="btn btn-primary full-width mr-3 mb-2">Atbildēt</a>
                                @else
                                    <a href="/user/{{$message->receiver_id}}/compose-message" class="btn btn-primary full-width mr-3 mb-2">Rakstīt vēl vienu ziņu</a>
                                @endif
                                
                                @if (Auth::user()->id === $message->receiver_id)
                                    <form method="post" action="{{route('received.message.delete', $message->id)}}" class="d-inline align-top">
                                        @csrf
                                        <button type="submit" class="btn btn-danger full-width">Dzēst ziņu</button>
                                    </form>
                                @else
                                    <form method="post" action="{{route('sent.message.delete', $message->id)}}" class="d-inline align-top">
                                        @csrf
                                        <button type="submit" class="btn btn-danger full-width">Dzēst ziņu</button>
                                    </form>
                                @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>