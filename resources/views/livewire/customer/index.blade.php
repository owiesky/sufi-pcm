<?php

use Livewire\Attributes\{Layout, Title, Computed};
use Livewire\Volt\Component;
use Livewire\WithPagination;
use App\Models\Customer;

new
#[Layout('layouts.app')]
#[Title('Customer component using Volt')]
class extends Component {
    use WithPagination;

    public $customers, $customerid, $name, $description;
    public bool $showCustomerModal = false;

    public function add(){
        dd('Open Modal Form Add Customer');
    }

    public function save(){
        dd('Button Save clicked');
    }

    public function edit($id){
        dd('Customer ID : ' . $id);
    }

    public function delete($id){
        dd('Customer ID : ' . $id);
    }
};

?>

<div>
    @php
        $customers = App\Models\Customer::paginate(5);
        $headers = [
        ['key' => 'id', 'label' => '#', 'class' => 'bg-red-100 w-1'],
        ['key' => 'name', 'label' => 'Customer Name'],
        ['key' => 'description', 'label' => 'Description', 'class' => 'hidden lg:table-cell'],
        ['key' => 'action', 'label' => 'Action']];
    @endphp

    <x-mary-header title="Customer" subtitle="Manajemen Data">
        <x-slot:middle class="!justify-end">
            <x-mary-input icon="o-magnifying-glass" placeholder="Search..." />
        </x-slot:middle>
        <x-slot:actions>
            <x-mary-button icon="o-plus" @click="$wire.showCustomerModal = true" class="btn-primary" />
        </x-slot:actions>
    </x-mary-header>

    <x-mary-table :headers="$headers" :rows="$customers" with-pagination >
        @scope('cell_id', $customer)
            <strong>{{ $customer->id }}</strong>
        @endscope

        @scope('header_name', $header)
            <h2 class="text-base ">{{ $header['label'] }}</h2>
        @endscope

        @scope('header_description', $header)
            <div class="text-base">{{ $header['label'] }}</div>
        @endscope

        @scope('actions', $customer)
        <div class="flex justify-center">
            <x-mary-button icon="o-pencil" wire:click="edit({{ $customer->id }})" spinner class="btn-sm mx-3"/>
            <x-mary-button icon="o-trash" wire:click="delete({{ $customer->id }})" spinner class="btn-sm" />
        </div>
        @endscope
    </x-mary-table>

    <x-mary-modal  wire:model="showCustomerModal" title="Tambah Data" separator>
        <div>
            <div >
                <x-mary-form wire:submit="save">
                    <x-mary-input class="bg-slate-50" label="Nama" wire:model="name" />
                    <x-mary-input class="bg-slate-50" label="Deskripsi" wire:model="description" />

                </x-mary-form>
            </div>

            <x-slot:actions>
                <x-mary-button label="Batal" @click="$wire.showCustomerModal = false" />
                <x-mary-button label="Simpan" class="btn-primary" wire:click="save" />
            </x-slot:actions>
        </div>
    </x-mary-modal>
</div>


