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
                <p class="text-truncate">{{$message->title}}</p>
            </li>
        </div>
    @endforeach
</div>