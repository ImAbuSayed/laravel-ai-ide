<div>
    <h3 class="text-lg font-semibold mb-4">Models</h3>
    @foreach($models as $index => $model)
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Model Name</label>
            <input type="text" wire:model="models.{{ $index }}.name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Model Content</label>
            <textarea wire:model="models.{{ $index }}.content" rows="6" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
        </div>
        <button wire:click="removeModel({{ $index }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Remove Model</button>
    @endforeach
    <button wire:click="addModel" class="mt-4 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Add Model</button>
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
    <button wire:click="generateModelsWithAI" class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Generate Models with AI
    </button>
</div>
