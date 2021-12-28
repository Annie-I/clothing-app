{{-- Show user message list --}}
<div class="row">
    @if (count($userMessages) === 0)
        <p>Nav atrasts neviens sludinājums.</p>
    @endif
    @foreach ($userMessages as $message)
        <div>
            <li class="list-group-item">
                <p>
                @if (!$message->read_at && $message->receiver_id === Auth::id())
                    <span class="badge bg-secondary">Nelasīts</span>
                @endif
                @if ($message->sender_id === Auth::id())
                    Kam: {{$message->receiver->first_name}} {{$message->receiver->last_name}}
                @else
                    No: {{$message->sender->first_name}} {{$message->sender->last_name}}
                @endif

                </p>
                <a href="/message/{{$message->id}}/read" class="fw-bold text-truncate">{{$message->title}}</a>
            </li>
        </div>
    @endforeach
</div>