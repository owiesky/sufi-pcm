@php
    $headers = [
    ['key' => 'id', 'label' => '#', 'class' => 'bg-red-100 w-1'],
    ['key' => 'name', 'label' => 'Nama'],
    ['key' => 'description', 'label' => 'Deskripsi', 'class' => 'hidden lg:table-cell']];
@endphp

<div>
    @php
        $suppliers = App\Models\Supplier::paginate(5);
        $headers = [
        ['key' => 'id', 'label' => '#', 'class' => 'bg-red-100 w-1'],
        ['key' => 'name', 'label' => 'Nama'],
        ['key' => 'description', 'label' => 'Deskripsi', 'class' => 'hidden lg:table-cell']];
    @endphp

    <x-mary-header title="Supplier" subtitle="Manajemen Data">
        <x-slot:middle class="!justify-end">
            <x-mary-input icon="o-magnifying-glass" placeholder="Search..." />
        </x-slot:middle>
        <x-slot:actions>
            <x-mary-button icon="o-plus" class="btn-primary" @click="$wire.showSupplierModal = true"/>
        </x-slot:actions>
    </x-mary-header>

    <x-mary-table :headers="$headers" :rows="$suppliers" with-pagination >
        @scope('cell_id', $supplier)
            <strong>{{ $supplier->id }}</strong>
        @endscope

        @scope('header_name', $header)
            <h2 class="text-base ">{{ $header['label'] }}</h2>
        @endscope

        @scope('header_description', $header)
            <div class="text-base">{{ $header['label'] }}</div>
        @endscope

        @scope('actions', $supplier)
        <div class="flex justify-center">
            <x-mary-button icon="o-pencil" spinner class="btn-sm mx-3" @click="$wire.showSupplierModal = true" />
            <x-mary-button icon="o-trash" wire:click="delete({{ $supplier->id }})" spinner class="btn-sm" />
        </div>
        @endscope
    </x-mary-table>

    <x-mary-modal  wire:model="showSupplierModal" title="Tambah Data" separator>
        <div>
            <x-mary-form wire:submit="save">
                <x-mary-input class="bg-slate-50" label="Name" wire:model="name" />
                <x-mary-input class="bg-slate-50"  label="Deskripsi" wire:model="description" />

                <x-slot:actions>
                    <x-mary-button label="Batal" @click="$wire.showSupplierModal = false" />
                    <x-mary-button label="Simpan" class="btn-primary" type="submit" spinner="save" />
                </x-slot:actions>
            </x-mary-form>
        </div>
    </x-mary-modal>


</div>
