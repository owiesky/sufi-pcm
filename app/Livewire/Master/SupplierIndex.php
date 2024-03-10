<?php

namespace App\Livewire\Master;

use App\Livewire\Forms\SupplierForm;
use App\Models\Supplier;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class SupplierIndex extends Component
{
    use WithPagination;
    public SupplierForm $form;
    public bool $showSupplierModal = false;

    public function render(): View
    {
        return view('livewire.master.supplier-index', [
            'suppliers' => Supplier::paginate(5),
        ]);
    }

    public function add()
    {
        $this->showSupplierModal = true;
        $this->form->setCreate();
    }

    public function edit($id)
    {
        $this->showSupplierModal = true;
        $supplier = Supplier::findorfail($id);
        $this->form->setUpdate($supplier);
    }

    public function cancel()
    {
        $this->showSupplierModal = false;
        $this->form->doCancel();
    }

    public function save()
    {
        $this->form->store();
        $this->showSupplierModal = false;
    }

    public function delete($id)
    {
        $this->form->doDelete($id);
    }
}
