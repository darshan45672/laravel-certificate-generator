<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class Counter extends Component
{
    use WithFileUploads;

    public $file;

    public function updatedFile()
    {
        $this->validate([
            'file' => 'image|max:1024', 
        ]);
    }

    public function render()
    {
        return view('livewire.counter');
    }
}
