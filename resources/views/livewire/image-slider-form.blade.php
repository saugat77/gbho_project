<x-box>
    <form wire:submit.prevent="save">
        <x-form.form-group>
            <div class="grey lighten-4 border position-relative overflow-hidden" style="height:400px; 
            background: url('{{ $imageUrl }}'); background-repeat: no-repeat; background-size: 100% 100%;">

                <div class="position-absolute d-grid h-100 w-100 bg-transparent" style="display: grid;">
                    <div style="place-self: center;">
                        <input wire:model="image" type="file" id="slider_image" class="d-none" accept="image/*">
                        <label for="slider_image" class="btn btn-light">
                            <span wire:loading wire:target="image">Uploading..</span>
                            <span wire:loading.remove wire:target="image">Choose Image</span>
                        </label>
                    </div>
                </div>
            </div>
            @error('image')
            <p class="text-red">{{ $message }}</p>
            @enderror
            {{-- Max 10 MB --}}
        </x-form.form-group>

        <div class="row">
            <div class="col-md-6">
                <x-form.form-group>
                    <x-form.label class="required">Group</x-form.label>
                    <select wire:model="imageSlider.group" id="" class="custom-select {{ invalid_class('imageSlider.group') }}">
                        <option value="">Select... </option>
                        @foreach(config('constants.image_slider.groups') as $group)
                        <option value="{{ $group }}">{{ ucfirst($group) }}</option>
                        @endforeach
                    </select>
                    @error('imageSlider.group')
                    <p class="text-red">{{ $message }}</p>
                    @enderror
                </x-form.form-group>
            </div>
            <div class="col-md-6">
                <x-form.form-group>
                    <x-form.label class="required">Position</x-form.label>
                    <input wire:model.defer="imageSlider.position" type="number" class="form-control {{ invalid_class('imageSlider.position') }}" />
                    @error('imageSlider.position')
                    <p class="text-red">{{ $message }}</p>
                    @enderror
                </x-form.form-group>
            </div>
        </div>

        <x-form.form-group>
            <x-form.label>Title</x-form.label>
            <input wire:model.defer="imageSlider.title" class="form-control {{ invalid_class('imageSlider.title') }}" />
            @error('imageSlider.title')
            <p class="text-red">{{ $message }}</p>
            @enderror
        </x-form.form-group>

        <div class="row">
            <div class="col-md-6">
                <x-form.form-group>
                    <x-form.label>Action Link</x-form.label>
                    <input wire:model.defer="imageSlider.action_link" class="form-control {{ invalid_class('imageSlider.action_link') }}" />
                    @error('imageSlider.action_link')
                    <p class="text-red">{{ $message }}</p>
                    @enderror
                </x-form.form-group>
            </div>
            <div class="col-md-6 d-flex">
                <x-form.form-group class="align-self-center">
                    <label for=""></label>
                    <div class="custom-control custom-checkbox">
                        <input wire:model.defer="imageSlider.open_in_new_tab" type="checkbox" class="custom-control-input" id="checkbox-open-in-new-tab">
                        <label class="custom-control-label" for="checkbox-open-in-new-tab">Open in new tab</label>
                    </div>
                    @error('imageSlider.open_in_new_tab')
                    <p class="text-red">{{ $message }}</p>
                    @enderror
                </x-form.form-group>
            </div>
        </div>

        <x-form.form-group>
            <button type="submit" class="btn btn-primary text-capitalize px-5">{{ $imageSlider->exists ? 'Update' : 'Save' }}</button>
        </x-form.form-group>
    </form>
</x-box>
