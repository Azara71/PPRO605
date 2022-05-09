<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center']) }}>
    {{ $slot }}
</button>
