<x-app-layout>
    <x-slot name="content">
        <div class="container">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <p><a href="/user/{{$user->id}}" class="text-decoration-none text-secondary">< Atpakaļ uz lietotāja profilu</a></p>
                        <p class="fs-3 mb-3">Par lietotāju {{$user->first_name}} {{$user->last_name}} atstātās atsauksmes</p>
                        <div class="row">
                            @if (!count($reviews))
                                <p class="ml-2"> Par lietotāju pagaidām nav atstāta neviena atsauksme.</p>
                            @endif
                            @foreach ($reviews as $review)
                                <div class="mb-2">
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-12">
                                                <h5 class="fw-bold">Novērtējums: {{$review->rating}} / 5</h5>
                                                <p>{{$review->review}}</p>
                                                <p>No: 
                                                    <a href="/user/{{$review->user_id}}" class="fw-bold text-decoration-none">
                                                        {{$review->user->first_name}} {{$review->user->last_name}}
                                                    </a>
                                                </p>
                                            </div>
                                            @if (Auth::user()->is_admin)
                                                <div class="col-12">
                                                    <form method="post" action="{{route('review.delete', $review)}}">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger">Dzēst atsauksmi</button>
                                                    </form>
                                                </div>
                                            @endif
                                        </div>
                                    </li>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>
