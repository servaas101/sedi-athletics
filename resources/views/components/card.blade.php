<div {{ $attributes->merge(['class' => 'card']) }}>
    @isset($title)
        <div class="card-header">
            {{ $title }}
        </div>
    @endisset

    <div class="card-body">
        {{ $slot }}
    </div>

    @isset($footer)
        <div class="card-footer">
            {{ $footer }}
        </div>
    @endisset
</div>