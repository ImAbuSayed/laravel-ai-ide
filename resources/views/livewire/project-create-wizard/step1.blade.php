<div>
    <h3 class="text-lg font-semibold mb-4">Project Details</h3>
    <div class="mb-4">
        <label for="name" class="block text-sm font-medium text-gray-700">Project Name</label>
        <input type="text" id="name" wire:model="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
        @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
    </div>
    <div class="mb-4">
        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
        <textarea id="description" wire:model="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
        @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
    </div>
    <button wire:click="improveWithAI('description')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Improve Description with AI
    </button>
</div>
