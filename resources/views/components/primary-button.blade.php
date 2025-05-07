<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-primary btn text-base-300']) }}>
    {{ $slot }}
</button>
