@props([
    'name',
])

<label style="display: block; margin: 0.65rem 0 0.2rem; font-size: 0.85rem">
    <input type="checkbox" id="{{ $name }}" name="{{ $name }}" value="1" {{ $attributes }}>
    {{ ucfirst(str_replace('_', ' ', $name)) }}
</label>
