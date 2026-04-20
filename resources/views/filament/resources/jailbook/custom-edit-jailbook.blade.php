<x-filament::page>
    <div 
        x-data="{ tab: 'form' }"
        class="space-y-6"
    >

       
        <div style="display:flex; gap:10px; margin-bottom:16px;">

            <button type="button" @click="tab='form'"
                :style="tab==='form' 
                    ? 'background:#111827;color:white;padding:10px 18px;border-radius:10px;border:none;cursor:pointer;box-shadow:0 2px 6px rgba(0,0,0,0.15);' 
                    : 'background:#e5e7eb;color:#374151;padding:10px 18px;border-radius:10px;border:none;cursor:pointer;'">
                Case Info
            </button>

            <button type="button" @click="tab='fingerprint'"
                :style="tab==='fingerprint' 
                    ? 'background:#111827;color:white;padding:10px 18px;border-radius:10px;border:none;cursor:pointer;box-shadow:0 2px 6px rgba(0,0,0,0.15);' 
                    : 'background:#e5e7eb;color:#374151;padding:10px 18px;border-radius:10px;border:none;cursor:pointer;'">
                Fingerprint
            </button>

            <button type="button" @click="tab='marks'"
                :style="tab==='marks' 
                    ? 'background:#111827;color:white;padding:10px 18px;border-radius:10px;border:none;cursor:pointer;box-shadow:0 2px 6px rgba(0,0,0,0.15);' 
                    : 'background:#e5e7eb;color:#374151;padding:10px 18px;border-radius:10px;border:none;cursor:pointer;'">
                Identified Marks
            </button>

        </div>


    
        <div x-show="tab === 'form'" x-transition>
            <div class="bg-white dark:bg-gray-900 rounded-xl shadow p-8">

                <form wire:submit.prevent="save">

                    {{ $this->form }}

                  
                    <div style="margin-top:24px; padding-top:16px; border-top:1px solid #e5e7eb;"
                         class="flex justify-end gap-3">

                        <x-filament::button
                            color="gray"
                            tag="a"
                            href="{{ $this->getResource()::getUrl('index') }}"
                        >
                            Cancel
                        </x-filament::button>

                        <x-filament::button type="submit">
                            Save Changes
                        </x-filament::button>

                    </div>

                </form>

            </div>
        </div>


       
        <div x-show="tab === 'fingerprint'" x-transition>
            <div class="space-y-6">
                @foreach ($this->getRelationManagers() as $relationManager)
                    @if (str_contains($relationManager, 'Fingerprint'))
                        @livewire($relationManager, [
                            'ownerRecord' => $record,
                            'pageClass' => static::class,
                        ], key($relationManager))
                    @endif
                @endforeach
            </div>
        </div>


      
        <div x-show="tab === 'marks'" x-transition>
            <div class="space-y-6">
                @foreach ($this->getRelationManagers() as $relationManager)
                    @if (str_contains($relationManager, 'IdentifiedMarks'))
                        @livewire($relationManager, [
                            'ownerRecord' => $record,
                            'pageClass' => static::class,
                        ], key($relationManager))
                    @endif
                @endforeach
            </div>
        </div>

    </div>
</x-filament::page>