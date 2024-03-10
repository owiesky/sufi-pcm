<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UserForm extends Form
{
    public ?User $user = null;
    public string $id = '';

    #[Validate()]
    public string $name = '';
    #[Validate()]
    public string $username = '';
    #[Validate()]
    public string $phone = '';

    public bool $isAdd = false;
    public bool $isEdit = false;

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'min:5',
                Rule::unique('users', 'name')->ignore($this->user),
            ],
            'username' => [
                'required', 'min:5',
                Rule::unique('users', 'username')->ignore($this->user),
            ],
            'phone' => [
                'required', 'min:11', 'numeric',
                Rule::unique('users', 'phone')->ignore($this->user),
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama wajib di-isi',
            'name.min' => 'Minimal 5 karakter',
            'username.required' => 'Deskripsi wajib di-isi',
            'username.min' => 'Minimal 5 karakter',
        ];
    }

    public function setCreate(): void
    {
        $this->isAdd = true;
        $this->isEdit = false;
    }

    public function setUpdate(User $user = null): void
    {
        $this->isAdd = false;
        $this->isEdit = true;

        //$this->id = $user->id;
        $this->user = $user;
        $this->name = $user->name;
        $this->username = $user->username;
        $this->phone = $user->phone;
        //dd($this->name);
    }

    public function doDelete($id): void
    {
        try {
            User::find($id)->delete();
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
                User::create($validated);
                $this->reset();
                $this->isAdd = false;
                session()->flash('success', 'Data baru tersimpan.');
            } catch (\Exception $ex) {
                session()->flash('error', 'Terjadi kesalahan.');
            }
        } elseif ($this->isEdit === true) {
            try {
                //dd('doUpdate');
                $this->user->update($validated);
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
