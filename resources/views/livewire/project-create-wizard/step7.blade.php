<div>
    <h3 class="text-lg font-semibold mb-4">Views, Factories, Seeders, and Rules</h3>

    <!-- Views -->
    <div class="mb-6">
        <h4 class="text-md font-semibold mb-2">Views</h4>
        @foreach($views as $index => $view)
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">View Name</label>
                <input type="text" wire:model="views.{{ $index }}.name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <label class="block text-sm font-medium text-gray-700 mt-2">View Content</label>
                <textarea wire:model="views.{{ $index }}.content" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
            </div>
        @endforeach
        <button wire:click="addView" class="mt-2 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Add View</button>
    </div>

    <!-- Factories -->
    <div class="mb-6">
        <h4 class="text-md font-semibold mb-2">Factories</h4>
        @foreach($factories as $index => $factory)
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Factory Name</label>
                <input type="text" wire:model="factories.{{ $index }}.name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <label class="block text-sm font-medium text-gray-700 mt-2">Factory Content</label>
                <textarea wire:model="factories.{{ $index }}.content" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
            </div>
        @endforeach
        <button wire:click="addFactory" class="mt-2 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Add Factory</button>
    </div>

    <!-- Seeders -->
    <div class="mb-6">
        <h4 class="text-md font-semibold mb-2">Seeders</h4>
        @foreach($seeders as $index => $seeder)
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Seeder Name</label>
                <input type="text" wire:model="seeders.{{ $index }}.name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <label class="block text-sm font-medium text-gray-700 mt-2">Seeder Content</label>
                <textarea wire:model="seeders.{{ $index }}.content" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
            </div>
        @endforeach
        <button wire:click="addSeeder" class="mt-2 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Add Seeder</button>
    </div>

    <!-- Rules -->
    <div class="mb-6">
        <h4 class="text-md font-semibold mb-2">Rules</h4>
        @foreach($rules as $index => $rule)
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Rule Name</label>
                <input type="text" wire:model="rules.{{ $index }}.name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <label class="block text-sm font-medium text-gray-700 mt-2">Rule Content</label>
                <textarea wire:model="rules.{{ $index }}.content" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
            </div>
        @endforeach
        <button wire:click="addRule" class="mt-2 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Add Rule</button>
    </div>

    <div class="mt-4">
        <label for="aiPrompt" class="block text-sm font-medium text-gray-700">AI Prompt</label>
        <select wire:model="selectedPrompt" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <option value="">Select a pre-built prompt</option>
            @foreach($preBuiltPrompts as $prompt)
                <option value="{{ $prompt->id }}">{{ $prompt->name }}</option>
            @endforeach
        </select>
        <textarea id="aiPrompt" wire:model="aiPrompt" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Customize your AI prompt here"></textarea>
    </div>
    <button wire:click="generateWithAI" class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Generate with AI
    </button>
</div>
