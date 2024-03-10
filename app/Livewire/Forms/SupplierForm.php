<?php

namespace App\Livewire\Forms;

use App\Models\Supplier;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class SupplierForm extends Form
{
    public ?Supplier $supplier = null;
    public string $id = '';

    #[Validate()]
    public string $name = '';
    #[Validate()]
    public string $description = '';

    public bool $isAdd = false;
    public bool $isEdit = false;

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'min:5',
                Rule::unique('suppliers', 'name')->ignore($this->supplier),
            ],
            'description' => ['required', 'min:5'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama wajib di-isi',
            'name.min' => 'Minimal 5 karakter',
            'description.required' => 'Deskripsi wajib di-isi',
            'description.min' => 'Minimal 5 karakter',
        ];
    }

    public function setCreate(): void
    {
        $this->isAdd = true;
        $this->isEdit = false;
    }

    public function setUpdate(Supplier $supplier = null): void
    {
        $this->isAdd = false;
        $this->isEdit = true;

        //$this->id = $supplier->id;
        $this->supplier = $supplier;
        $this->name = $supplier->name;
        $this->description = $supplier->description;
        //dd($this->name);
    }

    public function doDelete($id): void
    {
        try {
            Supplier::find($id)->delete();
            session()->flash('success', "Berhasil dihapus");
        } catch (\Exception $e) {
            session()->flash('error', "Gagal dihapus");
        }
    }

    public function doCancel(): void
    {
        //dd('doCancel');
        $this->reset();
    }

    public function store(): void
    {
        $validated = $this->validate();
        if ($this->isAdd === true) {
            try {
                //dd('doCreate');
                Supplier::create($validated);
                $this->reset();
                $this->isAdd = false;
                session()->flash('success', 'Data baru tersimpan.');
            } catch (\Exception $ex) {
                session()->flash('error', 'Terjadi kesalahan.');
            }
        } elseif ($this->isEdit === true) {
            try {
                //dd('doUpdate');
                $this->supplier->update($validated);
                $this->reset();
                $this->isEdit = false;
                session()->flash('success', 'Data perubahan tersimpan.');
            } catch (\Exception $ex) {
                session()->flash('error', 'Terjadi kesalahan.');
            }
        }
        $this->reset();
    }
}
