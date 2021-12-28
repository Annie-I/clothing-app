{{-- Show user message list --}}
<div class="row">
    @if (count($userMessages) === 0)
        <p>Nav atrasts neviens sludinājums.</p>
    @endif
    @foreach ($userMessages as $message)
        <div>
            <li class="list-group-item">
                @if ($message->sender_id === Auth::user()->id)
                    <p>Kam: {{$message->receiver->first_name}} {{$message->receiver->last_name}}</p>
                @else
                    <p>No: {{$message->sender->first_name}} {{$message->sender->last_name}}</p>
                @endif
                <a href="/message/{{$message->id}}/read" class="fw-bold text-truncate">{{$message->title}}</a>
            </li>
        </div>
    @endforeach
</div>