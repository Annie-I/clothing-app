{{-- Show received complaint list --}}
<div class="row">
    @if (count($complaints) === 0)
        <p>Nav atrasts neviens sludinājums.</p>
    @endif
    @foreach ($complaints as $complaint)
        <div>
            <li class="list-group-item">
                <a href="#" class="text-decoration-none text-body">
                    <p class="mb-1">
                        Iesniedza: <span class="fw-bold">{{$complaint->user->first_name}} {{$complaint->user->last_name}}</span>
                    </p>
                    <p class="mb-1">Sūdzības priekšmets: <span class="fw-bold">{{$complaint->subject->name}}</span></p>
                </a>
            </li>
        </div>
    @endforeach
</div>