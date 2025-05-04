<div>
    <div class="grid sm:grid-cols-1 md:grid-cols-12">
        <div>
            <p class="text-2xl text-green-700 dark:text-gray-500 font-sans">USERS</p>
        </div>
        <div>
            {{-- @livewire('alerts.alert-success', ['message' => $alertMessage], key($alertMessage)) --}}
        </div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div class="mb-3">
            {{-- @livewire('forms.seg-user-form') --}}
        </div>
    </div>
    <div class="grid sm:grid-cols-1">
        <div></div>
        <div></div>
        <div></div>
        <div class="overflow-x-auto xl:overflow-x-hidden xl:overflow-y-hidden">
            @livewire('tables.user-table')
            {{-- @livewire('forms.lead-edit-form-modal')
            @livewire('forms.lead-to-client-convert-form') --}}
        </div>
        <div></div>
        <div></div>
        <div></div>
    </div>
</div>
