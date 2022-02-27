<?php

namespace App\Http\Livewire\Backend;

use Illuminate\Database\Eloquent\Model;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ContactMessage extends Component
{
    use LivewireAlert;

    public Model $model;

    public $field;

    public $status;

    public $uniqueId;

    public function mount()
    {
        $this->status = (bool) $this->model->getAttribute($this->field);
        $this->uniqueId = uniqid();
    }

    public function updating($field, $value)
    {
        $this->model->setAttribute($this->field, $value)->save();
        $this->alert('success', 'Message Status Changed Successfully');

    }

    public function render()
    {
        return view('livewire.backend.contact-message');
    }
}
