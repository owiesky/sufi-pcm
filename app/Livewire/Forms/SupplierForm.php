<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class SupplierForm extends Form
{
    #[Validate('required|string')]
    public string $name = '';

    #[Validate('required|string')]
    public string $description = '';

    public function add()
    {
        dd('Open Modal Form Add Customer');
    }

    public function save()
    {
        dd('Button Save clicked');
    }

    public function edit($id)
    {
        $showSupplierModal = true;
    }

    public function delete($id)
    {
        dd('Supplier ID : ' . $id);
    }
}
