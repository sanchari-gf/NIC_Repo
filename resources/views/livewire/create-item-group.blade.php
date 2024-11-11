@livewireStyles
<form wire:submit.prevent="submit">
    <div class="mb-3">
        <label for="name" class="form-label fw-bold">Item Group Name</label>
        <input type="text" wire:model="name" id="name" class="form-control" required placeholder="Enter item group name">
    </div>

    <button type="submit" class="btn btn-primary">Create</button>
</form>
@livewireScripts
