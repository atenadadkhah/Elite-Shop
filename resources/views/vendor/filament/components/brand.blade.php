
<div
    x-data="{ mode: 'light' }"
    x-on:dark-mode-toggled.window="mode = $event.detail"
>
    <span x-show="mode === 'light'">
        <img src="/{{ $_setting['logo']['header'] }}" alt="Logo" class="h-10">
    </span>

    <span x-show="mode === 'dark'">
        <img src="/{{ $_setting['logo']['footer'] }}" alt="Logo" class="h-10">
    </span>
</div>
