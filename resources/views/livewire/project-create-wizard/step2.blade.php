<div>
    <h3 class="text-lg font-semibold mb-4">Project Features</h3>
    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">Features</label>
        @foreach($features as $index => $feature)
            <div class="flex items-center mt-2">
                <input type="text" wire:model="features.{{ $index }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                <button wire:click="removeFeature({{ $index }})" class="ml-2 text-red-500">Remove</button>
            </div>
        @endforeach
        <button wire:click="addFeature" class="mt-2 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Add Feature</button>
    </div>
    <button wire:click="generateFeaturesWithAI" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Generate Features with AI
    </button>
    <div class="mt-4">
        <label class="flex items-center">
            <input type="checkbox" wire:model="use_authentication" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <span class="ml-2">Use Authentication</span>
        </label>
    </div>
    <div class="mt-2">
        <label class="flex items-center">
            <input type="checkbox" wire:model="use_api" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <span class="ml-2">Use API</span>
        </label>
    </div>
    <div class="mt-2">
        <label class="flex items-center">
            <input type="checkbox" wire:model="use_admin_panel" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
            <span class="ml-2">Use Admin Panel</span>
        </label>
    </div>
</div>
