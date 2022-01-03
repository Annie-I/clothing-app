<x-app-layout>
    <x-slot name="content">
        <div class="container p-5">
            <p class="text-center fs-3 fw-bold mt-5">Jums nav ļauts veikt šo darbību.</p>
            <p class="d-flex justify-content-center"><a href="{{URL::previous()}}" class="text-decoration-none text-secondary">< Atgriezties</a></p>
        </div>
    </x-slot>
</x-app-layout>