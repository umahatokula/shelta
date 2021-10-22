<div>
    <x-modal wire:model="show">

        {{-- <livewire:transactions.transactions-create /> --}}
        <livewire:dynamic-component component="{{$comp}}" />


    </x-modal>
</div>