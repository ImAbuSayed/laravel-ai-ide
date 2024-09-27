<div>
    <h3 class="text-lg font-semibold mb-4">Controllers</h3>
    @foreach($controllers as $index => $controller)
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Controller Name</label>
            <input type="text" wire:model="controllers.{{ $index }}.name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">Controller Content</label>
            <textarea wire:model="controllers.{{ $index }}.content" rows="6" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
        </div>
        <button wire:click="removeController({{ $index }})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Remove Controller</button>
    @endforeach
    <button wire:click="addController" class="mt-4 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Add Controller</button>
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
    <button wire:click="generateControllersWithAI" class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Generate Controllers with AI
    </button>
</div>
