<?php

namespace App\Http\Livewire;

use App\Models\File;
use App\Models\User;
use Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Files extends Component
{
    use WithFileUploads;

    // Declared Vars
    public $files, $file, $name, $full_url, $user_id, $path, $users, $pdf;
    public $modal = 0;

    public function render()
    {
        $this->files = File::all();
        return view('livewire.file.files');
    }

    public function create()
    {
        $this->clearInputs();
        $this->users = User::where('active', 1)->select('id', 'name', 'username')->get();
        $this->openModal();
    }

    public function show($id)
    {
        $this->file = File::findOrFail($id);
        return view('livewire.file');
    }

    public function saveFile()
    {
        $this->validate([
            'user_id' => ['required', 'numeric', 'exists:users,id'],
            'pdf' => ['required', 'mimes:pdf', 'max:1000'],
        ]);
        $file = File::where('user_id', $this->user_id)->first();
        if ($file) {
            Storage::disk('public')->delete($file->path);
            Storage::disk('public')->delete($this->user_id . '.pdf');
        }
        $response = $this->pdf->storeAs('pdf', $this->user_id . ".pdf", $disk = 'public');
        File::updateOrCreate(
            ["user_id" => $this->user_id],
            [
                "path" => $response,
                "full_url" => url('/') . Storage::url($response),
                "name" => $this->user_id
            ]
        );
        $this->closeModal();
        $this->clearInputs();
    }

    public function edit($id)
    {
        $file = File::findOrFail($id);
        $this->id = $id;
        $this->path = $file->path;
        $this->user_id = $file->user_id;
        $this->full_url = $file->full_url;
        $this->name = $file->name;
        $this->openModal();
    }

    public function delete($id)
    {
        $this->file = File::findOrFail($id);
        Storage::disk('public')->delete($this->file->path);
        Storage::disk('public')->delete('pdf/' . $this->file->user_id . '.pdf');
        $this->file->delete();
    }

    public function deleteByUser($user_id)
    {
        $files = File::where('user_id', $user_id)->get();
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

    protected function cleanupOldUploads()
    {
        $storage = Storage::disk('local');

        foreach ($storage->allFiles('livewire-temp') as $filePathname) {
            $yesterdaysStamp = now()->subDay()->timestamp;

            if ($yesterdaysStamp > $storage->lastModified($filePathname)) {
                $storage->delete($filePathname);
            }
        }
    }
}
