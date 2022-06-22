<div>
    <x-box class="mb-4">
        <form action="" class="form-inline">
            <div class="form-row align-items-center">
                <div class="col-auto form-group">
                    <input wire:model="filter.name" type="text" class="form-control" placeholder="Name">
                </div>
                <div class="col-auto form-group">
                    <input wire:model="filter.email" type="email" class="form-control" placeholder="Email address">
                </div>
                <div class="col-auto form-group ">
                    <select wire:model="filter.role" class="custom-select">
                        <option value="all">All Roles</option>
                        @foreach (config('authorization.roles') as $role)
                        <option value="{{ $role }}">{{ ucfirst($role) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-auto form-group ">
                    <select wire:model="filter.status" class="custom-select">
                        <option value="all">Active & Inactive</option>
                        <option value="active">Active</option>
                        <option value="inactive">Deactive</option>
                    </select>
                </div>
                <div class="col-auto">
                    <button wire:click="resetFilter()" class="btn btn-primary" type="button">Reset</button>
                </div>
            </div>
        </form>
    </x-box>

    <x-box class="rounded">
        <div class="mb-3">
            <select wire:model="paginate" class="custom-select w-auto">
                <option value="5">5</option>
                <option value="15">15</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="10">100</option>
            </select> records per page
        </div>
        <table class="table table-hover table-responsive-sm">
            <tr class="text-uppercase font-poppins">
                <th>#</th>
                <th>User</th>
                <th>Contact</th>
                <th>Roles</th>
                <th>Joined At</th>
                <th>Status</th>
                <th class="text-right">Action</th>
            </tr>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <div class="d-flex align-items-center">
                            <img class="img-circle" src="{{ $user->gravatar }}" style="height: 40px; height: 40px; padding: 2px; border: 1px solid #c2c3c4;">
                            <div class="ml-3">
                                <div>{{ $user->name }}</div>
                                <div>{{ $user->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td>{{ $user->mobile ?? 'N/A' }}</td>
                    <td>
                        @foreach($user->roles as $role)
                        {{ ucFirst($role->name) }}
                        @endforeach
                    </td>
                    <td>{{ $user->created_at->isoFormat('ll') }}</td>
                    <td class="{{ $user->isActive() ? 'text-success' : 'text-danger' }}">
                        {{ $user->isActive() ? 'Active' : 'Inactive' }}
                    </td>
                    <td class="text-right">
                        <div class="dropdown">
                            <button class="btn btn-primary text-md text-white btn-sm py-1 px-2 my-0 z-depth-0" type="button" id="user-action-{{ $loop->iteration }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="svg-icon svg-baseline">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                    </svg>
                                </span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="user-action-{{ $loop->iteration }}">
                                <a class="dropdown-item" href="{{ route('users.edit', $user) }}">Edit</a>
                                @if($user->isActive())
                                <button class="dropdown-item" onclick="confirm('Sure to deactivate?') || event.stopImmediatePropagation()" wire:click="deactivate({{ $user->id }})">Deactivate</button>
                                @else
                                <button class="dropdown-item" onclick="confirm('Sure to activate?') || event.stopImmediatePropagation()" wire:click="activate({{ $user->id }})">Activate</button>
                                @endif
                            </div>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="42" class="text-center font-italic">No Record Exists</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="d-flex justify-content-between py-3">
            <div class="mb-3 text-muted">
                Showing records {{ $users->firstItem() }} - {{ $users->lastItem() }} of {{ $users->total() }}
            </div>
            {{ $users->links() }}
        </div>
    </x-box>
</div>
