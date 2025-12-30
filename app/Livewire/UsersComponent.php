<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsersComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $addPage = false;
    public function render()
    {
        $data['user']=User::paginate(10);
        return view('livewire.users-component',$data);
    }
    
    public function create(){
        $this->addPage = true;
    }
}
