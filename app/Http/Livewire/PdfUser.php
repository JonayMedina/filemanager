<?php

namespace App\Http\Livewire;

use App\Models\FileChecked;
use Auth;
use Livewire\Component;

class PdfUser extends Component
{
    public $file, $checked, $user;

    public function render()
    {
        $this->user = Auth::user();
        $this->checked = FileChecked::where('user_id', $this->user->id)->whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))->first();
        // dd($checked);
        return view('livewire.pdf.user-pdf');
    }

    public function acceptPdf($user_id)
    {
        $this->checked = FileChecked::create([
            'user_id' => $user_id,
            'name' => $this->user->username
        ]);
    }
}
