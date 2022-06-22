<div>
    @if($profileUpdated)
    <div wire:click="$set('profileUpdated', false)" class="bg-green-100 border-t-4 border-green-500 rounded-b text-green-900 px-4 py-3 mb-3 shadow cursor-pointer" role="alert">
        <div class="flex">
            <div class="py-1"><svg class="fill-current h-6 w-6 text-green-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" /></svg></div>
            <div>
                <p class="font-bold">Your profile has been updated</p>
                <p class="text-sm">Make sure you know how these changes affect you.</p>
            </div>
        </div>
    </div>
    @endif
    <form wire:submit.prevent="updateProfile">
        <div>
            <label class="block mb-2">Name</label>
            <input wire:model="user.name" type="text" class="form-input w-full @error('user.name')  border-red-500 @enderror">
            <x-tailwind-invalid-feedback field="user.name" />
        </div>
        <div class="my-3">
            <label class="block mb-2">Email</label>
            <div class="bg-gray-200 py-2 px-3 rounded">{{ $user->email }}</div>
        </div>
        <div class="my-3">
            <label class="block mb-2">Mobile</label>
            <input wire:model="user.mobile" type="text" class="form-input w-full @error('user.mobile')  border-red-500 @enderror">
            <x-tailwind-invalid-feedback field="user.mobile" />
        </div>
        <div class="my-3">
            <label class="block mb-2">Gender</label>
            <div class="flex gap-5">
                <div>
                    <label class="inline-flex items-center">
                        <input wire:model="user.gender" type="radio" class="form-radio" name="gender" value="male">
                        <span class="ml-2">Male</span>
                    </label>
                </div>
                <div>
                    <label class="inline-flex items-center">
                        <input wire:model="user.gender" type="radio" class="form-radio" name="gender" value="female">
                        <span class="ml-2">Female</span>
                    </label>
                </div>
            </div>
            <x-tailwind-invalid-feedback field="user.gender" />
        </div>
        <div>
            <button type="submit" class="bg-gray-800 hover:bg-gray-900 text-white text-lg py-2 px-5 rounded my-3 hover:shadow focus:outline-none focus:shadow-outline">Save</button>
        </div>
    </form>
</div>
