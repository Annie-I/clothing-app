<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <x-head/>
    <body class="font-sans antialiased">
        <!-- <div class="min-h-screen bg-gray-100"> -->

            <!-- Page Heading -->
            <header class="shadow">
                <x-top-menu/>
            </header>

            <!-- Page Content -->
            <main>
                {{ $content }}
            </main>
        </div>
    </body>
</html>
