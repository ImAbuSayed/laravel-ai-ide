<div class="bg-gray-100">
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-3xl font-bold text-orange-600">Projects</h2>
            <a href="{{ route('project.create') }}" class="bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded">New Project</a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($projects as $project)
                <div class="bg-white shadow rounded-lg p-4">
                    <h3 class="text-lg font-semibold text-orange-600">{{ $project->name }}</h3>
                    <p class="text-gray-600">{{ $project->description }}</p>
                    <a href="{{ route('project.view', $project) }}" class="text-orange-500 hover:underline">View Project</a>
                </div>
            @endforeach
        </div>
    </div>
</div>
