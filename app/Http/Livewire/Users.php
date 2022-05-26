<?php

namespace App\Http\Livewire;

use App\Models\File;
use App\Models\User;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;

class Users extends Component
{
    // Declared Vars
    public $users, $user, $name, $username, $email, $role, $password;
    public $modal = 0;

    protected $rules_save = [
        'name' => ['sometimes', 'string', 'min:5', 'max:100'],
        'username' => ['required', 'string', 'min:7', 'max:20'],
        'email' => ['sometimes', 'email', 'unique:users']
    ];

    public function render()
    {
        $this->users = User::all();
        return view('livewire.user.users');
    }

    public function create()
    {
        $this->clearInputs();
        $this->openModal();
    }

    public function show($id)
    {
        $this->user = User::findOrFail($id);
    }

    public function saveUser()
    {

        $this->validate($this->rules_save);
        $str = $this->generateStr();
        User::create([
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'role' => ($this->role) ?: 2,
            'str' => $str,
            'password' => Hash::make($str),
        ]);
        $this->closeModal();
        $this->clearInputs();
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->id = $id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->username = $user->username;
        $this->openModal();
    }

    public function delete($id)
    {
        $files = File::where('user_id', $id)->get();
        foreach ($files as $file) {
            Storage::disk('public')->delete($file->path);
            Storage::disk('public')->delete($file->user_id . '.pdf');
            $file->delete();
        }
        User::findOrFail($id)->delete();
    }

    public function openModal()
    {
        $this->modal = true;
    }

    public function closeModal()
    {
        $this->modal = false;
    }

    public function clearInputs()
    {
        $this->name = '';
        $this->user_id = null;
        $this->full_url = '';
        $this->path = '';
        $this->pdf = null;
    }

    protected function generateStr()
    {
        return Str::ramdom(8);
    }
}
