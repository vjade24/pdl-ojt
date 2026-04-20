<x-filament::page>
    <div 
        x-data="{ tab: 'form' }"
        class="space-y-6"
    >

        {{-- 🔷 TAB BUTTONS --}}
        <div style="display:flex; gap:10px; margin-bottom:16px; flex-wrap:wrap;">

            {{-- PROFILE --}}
            <button type="button" @click="tab='form'"
                :style="tab==='form' 
                    ? activeTabStyle() 
                    : inactiveTabStyle()">
                Profile
            </button>

            {{-- JAILBOOK --}}
            <button type="button" @click="tab='jailbook'"
                :style="tab==='jailbook' 
                    ? activeTabStyle() 
                    : inactiveTabStyle()">
                Jailbooks
            </button>

        </div>

        {{-- 🔷 STYLES --}}
        <script>
            function activeTabStyle() {
                return 'background:#111827;color:white;padding:10px 18px;border-radius:10px;border:none;cursor:pointer;box-shadow:0 2px 6px rgba(0,0,0,0.15);';
            }

            function inactiveTabStyle() {
                return 'background:#e5e7eb;color:#374151;padding:10px 18px;border-radius:10px;border:none;cursor:pointer;';
            }
        </script>


        {{-- 🔷 PROFILE FORM --}}
        <div x-show="tab === 'form'" x-transition>
            <div class="bg-white dark:bg-gray-900 rounded-xl shadow p-8">

                <form wire:submit.prevent="save">

                    {{ $this->form }}

                    {{-- ACTION BUTTONS --}}
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


        {{-- 🔷 JAILBOOK TAB --}}
        <div x-show="tab === 'jailbook'" x-transition>
            <div class="space-y-6">

                @foreach ($this->getRelationManagers() as $relationManager)
                    @if ($relationManager === \App\Filament\Resources\InmateProfiles\RelationManagers\JailbookRelationManager::class)
                        @livewire($relationManager, [
                            'ownerRecord' => $record,
                            'pageClass' => static::class,
                        ], key('jailbook'))
                    @endif
                @endforeach

            </div>
        </div>

    </div>
</x-filament::page>