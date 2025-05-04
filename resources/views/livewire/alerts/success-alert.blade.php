<div>
    @if ($message)
        <div
            x-data="{ show: true }"
            x-init="setTimeout(() => { show = false; $wire.set('message', null) }, 3000)"
            x-show="show"
            x-transition
            class="fixed bottom-5 left-5 z-[9999]"
        >
            <div class="grid sm:grid-cols-1 md:grid-cols-3">
            <div>
                <x-wireui:alert title="{{ $message }}" positive />
            </div>
            <div></div>
            <div></div>
            </div>
        </div>
    @endif
</div>
