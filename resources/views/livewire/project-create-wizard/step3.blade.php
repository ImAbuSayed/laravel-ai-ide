<div>
    <h3 class="text-lg font-semibold mb-4">Database Design</h3>
    <div class="mb-4">
        <label for="database_design" class="block text-sm font-medium text-gray-700">Database Design</label>
        <textarea id="database_design" wire:model="database_design" rows="6" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
        @error('database_design') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
    </div>
    <div class="mb-4">
        <label for="aiPrompt" class="block text-sm font-medium text-gray-700">AI Prompt</label>
        <select wire:model="selectedPrompt" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <option value="">Select a pre-built prompt</option>
            @foreach($preBuiltPrompts as $prompt)
                <option value="{{ $prompt->id }}">{{ $prompt->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-4">
        <textarea id="aiPrompt" wire:model="aiPrompt" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="Customize your AI prompt here"></textarea>
    </div>
    <button wire:click="generateDatabaseDesignWithAI" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Generate Database Design with AI
    </button>
</div>
