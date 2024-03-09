<?php

namespace App\Livewire\Master;

use App\Livewire\Forms\SupplierForm;
use App\Models\Supplier;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class SupplierList extends Component
{
    public bool $showSupplierModal = false;
    public SupplierForm $form;

    public function render(): View
    {
        return view('livewire.master.supplier-list', [
            'suppliers' => Supplier::paginate(5),
        ]);
    }

    public function save()
    {
        dd('Button Save clicked');
    }

    public function edit($id)
    {
        dd('Edit Supplier ID : ' . $id);
    }

    public function delete($id)
    {
        dd('Delete Supplier ID : ' . $id);
    }
}
