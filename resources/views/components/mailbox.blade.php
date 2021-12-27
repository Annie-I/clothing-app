{{-- Show user message list --}}
<div class="row">
    {{-- @if (count($userMessages) === 0)
        <p>Nav atrasts neviens sludinājums.</p>
    @endif --}}
    {{-- @foreach ($userMessages as $message) --}}
        <div>
            <li class="list-group-item filler_text">Ziņa 1</li>
            <li class="list-group-item filler_text">Ziņa 2</li>
            <li class="list-group-item filler_text">Ziņa 3</li>
            <li class="list-group-item filler_text">Ziņa 4</li>
        </div>
    {{-- @endforeach --}}
</div>