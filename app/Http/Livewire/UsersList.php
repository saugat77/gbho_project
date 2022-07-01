<?php

namespace App\Http\Livewire;

use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class UsersList extends Component
{
    use WithPagination;

    public $paginate = 15;
    protected $paginationTheme = 'bootstrap';

    public $filter = [
        'name' => null,
        'email' => null,
        'role' => 'all',
        'status' => 'all',
    ];

    protected $rules = [
        'user.name' => 'nullable',
        'user.email' => 'nullable',
        'user.role' => 'nullable',
    ];

    public function save()
    {
        // 
    }

    public function activate($id)
    {
        if (Auth::user()->hasAnyRole(['admin'])) {
            User::where('id', $id)->update(['status' => 1]);
            $this->emit('toast', ['default', 'User has been Activated']);
        } else {
            $this->emit('toast', ['default', 'You are not authorized for this action']);
        }
    }

    public function deactivate($id)
    {
        if (Auth::user()->hasAnyRole(['admin'])) {
            User::where('id', $id)->update(['status' => 0]);
            $this->emit('toast', ['default', 'User has been Deactivated']);
        } else {
            $this->emit('toast', ['default', 'You are not authorized for this action']);
        }
    }

    public function resetFilter()
    {
        $this->reset('filter');
    }

    public function render()
    {
        $users = User::with('roles');
        $users = $this->filter($users);
        $users = $users->latest()->paginate($this->paginate);

        return view('livewire.users-list', [
            'users' => $users
        ]);
    }

    protected function filter(Builder $users)
    {
        // filter by name
        if ($this->filter['name']) {
            $users = $users->where('name', 'like', '%' . $this->filter['name'] . '%');
        }

        // filter by email
        if ($this->filter['email']) {
            $users = $users->where('email', 'like', '%' . $this->filter['email'] . '%');
        }

        // filter by role
        if ($this->filter['role'] && $this->filter['role'] !== 'all') {
            $users = $users->role($this->filter['role']);
        }
        
        // filter by status
        if ($this->filter['status'] && $this->filter['status'] !== 'all') {
            if($this->filter['status'] === 'active'){
                $users = $users->active();
            }
            if($this->filter['status'] === 'inactive'){
                $users = $users->inactive();
            }
        }

        return $users;
    }
}
