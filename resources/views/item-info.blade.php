<x-app-layout>
    <x-slot name="content">
        <div class="container">
            <div class="row mt-10">
                <div class="col-12">
                    <x-single-item :item="$item" :user="$user" :state="$state"/>
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>