<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ $title ?? 'Laravel AI IDE' }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/default.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/copy-to-clipboard@3.3.3/index.min.js"></script>

    </head>
    <body class="min-h-screen bg-gray-100">
        <nav class="bg-black shadow-lg">
            <div class="max-w-7xl mx-auto px-4">
                <div class="flex justify-between">
                    <div class="flex space-x-7">
                        <div>
                            <a href="{{ route('dashboard') }}" class="flex items-center py-4 px-2">
                                <span class="font-semibold text-orange-500 text-lg">Laravel AI IDE</span>
                            </a>
                        </div>
                    </div>
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('dashboard') }}" class="py-2 px-2 font-medium text-white rounded hover:bg-orange-500 hover:text-white transition duration-300">Dashboard</a>
                        <a href="{{ route('project.create') }}" class="py-2 px-2 font-medium text-white rounded hover:bg-orange-500 hover:text-white transition duration-300">New Project</a>
                    </div>
                </div>
            </div>
        </nav>

        <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            {{ $slot }}
        </main>

        @livewireScripts
        <script>
            document.addEventListener('livewire:load', function () {
                Livewire.hook('message.processed', (message, component) => {
                    if (component.fingerprint.name === 'project-view') {
                        hljs.highlightAll();
                    }
                });
            });
        </script>
    </body>
</html>
