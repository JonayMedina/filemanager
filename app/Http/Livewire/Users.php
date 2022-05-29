<?php

namespace App\Http\Livewire;

use App\Models\File;
use App\Models\User;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class Users extends Component
{
    use WithPagination;
    // Declared Vars

    public $user_id, $user, $name, $username, $email, $role, $password;
    public $modal = 0;
    public $modal2 = 0;

    protected $rules_save = [
        'name' => ['sometimes', 'string', 'min:5', 'max:100'],
        'username' => ['required', 'string', 'min:7', 'max:20'],
        'email' => ['sometimes', 'email', 'unique:users']
    ];

    public function render()
    {
        $users = User::withCount('currentFileChecked')->with('currentFileChecked')->paginate(20);
        // dd($users);
        // $not_chequed = $users->where('current_file_checked_count', 0);
        return view('livewire.user.users', [
            'users' => $users
        ]);
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
        $this->user_id = $id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->username = $user->username;
        $this->role = $user->role;
        $this->openModalUser2();
    }

    public function updateUser($id)
    {
        $this->validate($this->updateRules());
        $user = User::findOrFail($id);
        $user->name = $this->name;
        $user->email = $this->email;
        $user->username = $this->username;
        $user->role = $this->role;
        $user->save();
        $this->closeModalUser2();
        $this->clearInputs();
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

    public function openModalUser2()
    {
        $this->modal2 = true;
    }

    public function closeModalUser2()
    {
        $this->modal2 = false;
    }

    public function clearInputs()
    {
        $this->name = null;
        $this->email = null;
        $this->username = null;
        $this->role = null;
        $this->user_id = null;
        $this->passowrd = null;
    }

    protected function generateStr()
    {
        return Str::random(8);
    }

    protected function updateRules()
    {
        return [
            'name' => ['sometimes', 'string', 'min:5', 'max:100'],
            'username' => ['required', 'string', 'min:7', 'max:20'],
            'email' => ['sometimes', 'email', 'unique:users,email,' . $this->user_id . ',id'],
        ];
    }
}
