@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-base-400']) }}>
    {{ $value ?? $slot }}
</label>
