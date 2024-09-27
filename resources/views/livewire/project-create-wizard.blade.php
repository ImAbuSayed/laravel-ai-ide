<div class="max-w-4xl mx-auto py-6 sm:px-6 lg:px-8">
    <h2 class="text-2xl font-bold mb-4">Create New Project</h2>

    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        <div class="mb-4">
            <div class="flex justify-between mb-2">
                <span>Step {{ $step }} of {{ $totalSteps }}</span>
                <span>{{ $step * 100 / $totalSteps }}% Complete</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $step * 100 / $totalSteps }}%"></div>
            </div>
        </div>

        @if ($step === 1)
            @include('livewire.project-create-wizard.step1')
        @elseif ($step === 2)
            @include('livewire.project-create-wizard.step2')
        @elseif ($step === 3)
            @include('livewire.project-create-wizard.step3')
        @elseif ($step === 4)
            @include('livewire.project-create-wizard.step4')
        @elseif ($step === 5)
            @include('livewire.project-create-wizard.step5')
        @elseif ($step === 6)
            @include('livewire.project-create-wizard.step6')
        @elseif ($step === 7)
            @include('livewire.project-create-wizard.step7')
        @endif

        <div class="flex justify-between mt-6">
            @if ($step > 1)
                <button wire:click="previousStep" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Previous
                </button>
            @else
                <div></div>
            @endif

            @if ($step < $totalSteps)
                <button wire:click="nextStep" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Next
                </button>
            @else
                <button wire:click="createProject" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Create Project
                </button>
            @endif
        </div>
    </div>
</div>
