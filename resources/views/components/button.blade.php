@props(['type' => 'button'])

@if ($type === 'link')
    <a {{ $attributes->merge(['class' => 'bg-blue-500 hover:bg-blue-700 text-white font-bold  p-2 m-1 rounded text-center']) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['class' => 'bg-blue-500 hover:bg-blue-700 text-white font-bold  p-2 m-1 rounded text-center']) }}>
        {{ $slot }}
    </button>
@endif
