@props([
    'type' => 'submit',
])

<button
    type="{{ $type }}"
    {{ $attributes }}
    style="margin-top: 0.85rem; margin-right: 0.5rem; padding: 0.5rem 0.85rem; cursor: pointer"
>
    {{ $slot }}
</button>
