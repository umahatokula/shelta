<div>
    <x-modal wire:model="show">

        @if ($show)

            {{-- <livewire:transactions.transactions-create /> --}}
            <livewire:dynamic-component component="{{$comp}}" index="{{$index}}" />

        @endif



    </x-modal>
</div>
