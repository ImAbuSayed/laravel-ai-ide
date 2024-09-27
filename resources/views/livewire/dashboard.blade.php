<div>
    <h1 class="text-3xl font-bold mb-6">Welcome to Laravel AI IDE</h1>

    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <h2 class="text-xl font-semibold mb-4">Dashboard Overview</h2>
        <p class="text-lg">Total Projects: {{ $projectCount }}</p>
    </div>

    <div class="bg-white shadow-md rounded-lg p-6">
        <h2 class="text-xl font-semibold mb-4">Recent Projects</h2>
        @if($recentProjects->count() > 0)
            <ul class="divide-y divide-gray-200">
                @foreach($recentProjects as $project)
                    <li class="py-4">
                        <a href="{{ route('project.view', $project) }}" class="flex items-center space-x-4">
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate">
                                    {{ $project->name }}
                                </p>
                                <p class="text-sm text-gray-500 truncate">
                                    {{ $project->description }}
                                </p>
                            </div>
                            <div>
                                <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-500">No projects created yet.</p>
        @endif
    </div>

    <div class="mt-6">
        <a href="{{ route('project.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Create New Project
        </a>
    </div>
</div>
