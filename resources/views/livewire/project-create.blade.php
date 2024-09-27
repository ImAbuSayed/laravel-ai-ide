<div>
    <h2 class="text-2xl font-bold mb-4">Create New Project</h2>
    <form wire:submit.prevent="createProject" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <div class="mb-4">
            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Project Name</label>
            <input type="text" id="name" wire:model="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
        <div class="mb-4">
            <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
            <textarea id="description" wire:model="description" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" rows="4"></textarea>
            @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
        <div class="mb-4">
            <label class="flex items-center">
                <input type="checkbox" wire:model="use_authentication" class="form-checkbox">
                <span class="ml-2 text-gray-700">Use Authentication</span>
            </label>
        </div>
        <div class="mb-4">
            <label class="flex items-center">
                <input type="checkbox" wire:model="use_api" class="form-checkbox">
                <span class="ml-2 text-gray-700">Use API</span>
            </label>
        </div>
        <div class="mb-4">
            <label class="flex items-center">
                <input type="checkbox" wire:model="use_admin_panel" class="form-checkbox">
                <span class="ml-2 text-gray-700">Use Admin Panel</span>
            </label>
        </div>
        <div class="flex items-center justify-between">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Create Project
            </button>
            <a href="{{ route('dashboard') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                Cancel
            </a>
        </div>
    </form>
</div>
