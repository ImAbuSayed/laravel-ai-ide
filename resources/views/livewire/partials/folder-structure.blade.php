<ul class="pl-4">
    @foreach ($structure as $item)
        <li class="py-1">
            @if ($item['type'] === 'directory')
                <span class="font-semibold">{{ $item['name'] }}/</span>
                @include('livewire.partials.folder-structure', ['structure' => $item['children']])
            @else
                <span>{{ $item['name'] }}</span>
            @endif
        </li>
    @endforeach
</ul>
