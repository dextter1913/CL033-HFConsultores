<div>
    <x-wireui:modal-card title="Edit Customer" blur="md" name="cardModal">
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
            <x-wireui:input label="Name" placeholder="Your full name" wire:model="name" />

            <x-wireui:input label="Email" type="email" placeholder="example@mail.com" wire:model="email" />

            <div class="flex items-center justify-center col-span-1 bg-gray-100 shadow-md cursor-pointer sm:col-span-2 dark:bg-secondary-700 rounded-xl h-64"
                x-data="{ preview: null }" @dragover.prevent
                @drop.prevent="let file = $event.dataTransfer.files[0]; if(file){ $refs.fileInput.files = $event.dataTransfer.files; preview = URL.createObjectURL(file); $wire.set('photo', file) }"
                @click="$refs.fileInput.click()">
                <input type="file" accept="image/*" class="hidden" x-ref="fileInput" wire:model="photo"
                    @change="if($event.target.files[0]){ preview = URL.createObjectURL($event.target.files[0]); }" />

                <template x-if="preview">
                    <img :src="preview" alt="Preview" class="object-contain h-48 rounded-lg" />
                </template>
                <template x-if="!preview">
                    <div class="flex flex-col items-center justify-center">
                        <x-wireui:icon name="cloud-arrow-up" class="w-16 h-16 text-blue-600 dark:text-teal-600" />
                        <p class="text-blue-600 dark:text-teal-600">Click or drop files here</p>
                    </div>
                </template>
            </div>
        </div>

        <x-slot name="footer" class="flex justify-between gap-x-4">
            <x-wireui:button flat negative label="Delete" x-on:click="close" />

            <div class="flex gap-x-4">
                <x-wireui:button flat label="Cancel" x-on:click="close" />

                <x-wireui:button primary label="Save" wire:click="saveData" />
            </div>
        </x-slot>
    </x-wireui:modal-card>
</div>
