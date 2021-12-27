<x-app-layout>
    <x-slot name="content">
        <div class="container">
            <div class="row mt-10">
                <div class="col-12">
                    <x-form-to-compose-message :user="$user"/>
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>
