<?php

namespace App\Livewire\Master;

use App\Livewire\Forms\CustomerForm;
use App\Models\Customer;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class CustomerIndex extends Component
{
    use WithPagination;
    public CustomerForm $form;
    public bool $showCustomerModal = false;

    public function render(): View
    {
        return view('livewire.master.customer-index', [
            'customers' => Customer::paginate(5),
        ]);
    }

    public function add()
    {
        $this->showCustomerModal = true;
        $this->form->setCreate();
    }

    public function edit($id)
    {
        $this->showCustomerModal = true;
        $customer = Customer::findorfail($id);
        $this->form->setUpdate($customer);
    }

    public function cancel()
    {
        $this->showCustomerModal = false;
        $this->form->doCancel();
    }

    public function save()
    {
        $this->form->store();
        $this->showCustomerModal = false;
    }

    public function delete($id)
    {
        $this->form->doDelete($id);
    }
}
