<x-app-layout>
    <x-slot name="content">
        <div class="container">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <p class="col-auto"><a href="/user/{{$user->id}}" class="text-decoration-none text-secondary">< Atpakaļ uz lietotāja profilu</a></p>
                        <p class="fs-3 m-2">Par lietotāju x y atstātās atsauksmes</p>
                        <div class="row">
                            @if (!count($reviews))
                                <p class="ml-2"> Par lietotāju pagaidām nav atstāta neviena atsauksme.</p>
                            @endif
                            @foreach ($reviews as $review)
                                <div>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-10">
                                                <h5 class="fw-bold">Novērtējums: {{$review->rating}} / 5</h5>
                                                <p>{{$review->review}}</p>
                                                <p>No: 
                                                    <a href="/user/{{$review->user_id}}" class="fw-bold text-decoration-none">
                                                        {{$review->user->first_name}} {{$review->user->last_name}}
                                                    </a>
                                                </p>
                                            </div>
                                            @if (Auth::user()->is_admin)
                                                <div class="col-2 mt-3">
                                                    <form method="post" action="{{route('review.delete', $review)}}">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger">Dzēst atsauksmi</p>
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
