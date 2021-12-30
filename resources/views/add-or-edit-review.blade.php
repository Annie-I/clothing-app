<x-app-layout>
    <x-slot name="content">
        <div class="container">
            <div class="row mt-10">
                <div class="col-12">
                    @if (!$review)
                        <x-form-to-add-review :user="$user"/>
                    @else
                        <x-form-to-edit-review :user="$user" :review="$review"/>
                    @endif
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>