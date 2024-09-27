<div class="bg-gray-100">
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold mb-4 text-orange-600">{{ $laravelProject->name }}</h2>
        <p class="text-gray-600 mb-4">{{ $laravelProject->description }}</p>

        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            <h3 class="text-xl font-semibold mb-2 text-orange-600">Project Details</h3>
            <div class="mb-2">
                <strong>Authentication:</strong> {{ $laravelProject->use_authentication ? 'Yes' : 'No' }}
            </div>
            <div class="mb-2">
                <strong>API:</strong> {{ $laravelProject->use_api ? 'Yes' : 'No' }}
            </div>
            <div class="mb-2">
                <strong>Admin Panel:</strong> {{ $laravelProject->use_admin_panel ? 'Yes' : 'No' }}
            </div>
        </div>

        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            <h3 class="text-xl font-semibold mb-4 text-orange-600">Project Structure</h3>
            @include('livewire.partials.folder-structure', ['structure' => $folderStructure])
        </div>

        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            <h3 class="text-xl font-semibold mb-4 text-orange-600">Project Files</h3>
            @if ($files->count() > 0)
                <ul class="divide-y divide-gray-200">
                    @foreach ($files as $file)
                        <li class="py-4">
                            <div class="flex items-center justify-between">
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate">
                                        {{ $file->file_path }}
                                    </p>
                                    <p class="text-sm text-gray-500 truncate">
                                        {{ \Illuminate\Support\Str::limit($file->content, 50) }}
                                    </p>
                                </div>
                                <div class="flex space-x-2">
                                    <button wire:click="viewFile({{ $file->id }})" class="px-2 py-1 bg-blue-500 text-white rounded">View</button>
                                    <button wire:click="editFile({{ $file->id }})" class="px-2 py-1 bg-yellow-500 text-white rounded">Edit</button>
                                    <button wire:click="deleteFile({{ $file->id }})" class="px-2 py-1 bg-red-500 text-white rounded">Delete</button>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-500">No files created yet.</p>
            @endif
        </div>

        <div class="bg-white shadow-md rounded-lg p-6">
            <h3 class="text-xl font-semibold mb-4 text-orange-600">Create New File</h3>
            <form wire:submit.prevent="createFile">
                <div class="mb-4">
                    <label for="newFileName" class="block text-gray-700 text-sm font-bold mb-2">File Name</label>
                    <input type="text" id="newFileName" wire:model="newFileName"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    @error('newFileName')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="newFileContent" class="block text-gray-700 text-sm font-bold mb-2">File Content</label>
                    <textarea id="newFileContent" wire:model="newFileContent"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        rows="6"></textarea>
                    @error('newFileContent')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="aiPrompt" class="block text-gray-700 text-sm font-bold mb-2">AI Prompt</label>
                    <textarea id="aiPrompt" wire:model="aiPrompt"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        rows="3"></textarea>
                </div>
                <div class="flex space-x-4">
                    <button type="submit"
                        class="bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Create File
                    </button>
                    <button type="button" wire:click="generateCode"
                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Generate with AI
                    </button>
                </div>
            </form>
        </div>
        @if ($formattedAiResponse)
            <div class="mt-6 bg-white shadow-md rounded-lg p-6">
                <h3 class="text-xl font-semibold mb-4 text-orange-600">AI Generated Code</h3>
                <div class="relative">
                    <div class="absolute top-0 left-0 m-2 px-2 py-1 bg-gray-200 text-xs font-semibold rounded">
                        {{ $newFileName ? pathinfo($newFileName, PATHINFO_EXTENSION) : 'php' }}
                    </div>
                    <button id="copyButton"
                        class="absolute top-0 right-0 m-2 px-2 py-1 bg-gray-200 hover:bg-gray-300 text-xs font-semibold rounded transition duration-200 ease-in-out"
                        onclick="copyToClipboard()">
                        Copy
                    </button>
                    <div class="prose max-w-none mt-8" id="codeContent">
                        {!! $formattedAiResponse !!}
                    </div>
                </div>
                <button wire:click="fillUpContent" class="mt-4 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                    Fill Up Content
                </button>
            </div>
        @endif
    </div>
    </div>

    <script>
        document.addEventListener('livewire:load', function() {
            Livewire.hook('message.processed', (message, component) => {
                if (component.fingerprint.name === 'project-view') {
                    hljs.highlightAll();
                }
            });
        });

        function copyToClipboard() {
            const codeContent = document.getElementById('codeContent').innerText;
            copy(codeContent);

            const copyButton = document.getElementById('copyButton');
            const originalText = copyButton.innerText;
            copyButton.innerText = 'Copied!';
            copyButton.disabled = true;
            setTimeout(() => {
                copyButton.innerText = originalText;
                copyButton.disabled = false;
            }, 2000);
        }
    </script>
</div>
