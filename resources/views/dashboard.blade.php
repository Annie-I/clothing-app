<x-app-layout>
    <x-slot name="content">
        <div class="container">
            <div class="row mt-10">
                <div class="col-12 col-md-3 mb-3">
                    {{-- display admin options only if user is marked as admin --}}
                    @if (Auth::user()->is_admin)
                        <x-admin-profile-menu/>
                    @else
                        <x-profile-menu/>
                    @endif
                </div>
                <div class="col-12 col-md-9">
                    <x-public-profile :user="$user" :isFavorited="$isFavorited ?? ''" :itemCount="$itemCount"/>
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>
