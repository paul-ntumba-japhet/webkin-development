@props([
    'name',
    'type' => 'text',
    'value' => '',
])

<label for="{{ $name }}" style="display: block; margin: 0.65rem 0 0.2rem; font-size: 0.85rem">
    {{ ucfirst(str_replace('_', ' ', $name)) }}
</label>
<input
    id="{{ $name }}"
    type="{{ $type }}"
    value="{{ $value }}"
    {{ $attributes->merge(['name' => $name]) }}
    style="width: 100%; padding: 0.45rem 0.5rem; box-sizing: border-box"
/>
