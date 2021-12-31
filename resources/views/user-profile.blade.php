<x-app-layout>
    <x-slot name="content">
        <div class="container">
            <div class="row mt-10">
                <div class="col-12">
                    <x-public-profile 
                        :user="$user" 
                        :isFavorited="$isFavorited ?? ''" 
                        :itemCount="$itemCount" 
                        :hasCommunicated="$hasCommunicated" 
                        :review="$review"
                        :reviews="$reviews"
                    />
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>
