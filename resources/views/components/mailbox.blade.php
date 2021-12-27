{{-- Show user message list --}}
<div class="row">
    @if (count($userMessages) === 0)
        <p>Nav atrasts neviens sludinājums.</p>
    @endif
    @foreach ($userMessages as $message)
        <div>
            <li class="list-group-item">
                @if ($message->sender_id === Auth::user()->id)
                    <p>Kam: {{$message->receiver_id}}</p>
                @else
                    <p>No: {{$message->sender_id}}</p>
                @endif
                <p class="text-truncate">{{$message->title}}</p>
            </li>
        </div>
    @endforeach
</div>