<x-app-layout>
    <x-slot name="content">
        <div class="container">
            <div class="row mt-10">
                <div class="col-12 col-md-3 mb-3">
                    <x-profile-menu/>
                </div>
                <div class="col-12 col-md-9">
                    <x-form-to-add-item/>
                </div>
            </div>
        </div>
    </x-slot>
</x-app-layout>