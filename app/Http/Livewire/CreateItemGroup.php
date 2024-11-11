<?php



namespace App\Http\Livewire;


use Livewire\Component;
use App\Models\ItemGroup;


class CreateItemGroup extends Component
{
    public $name;

    public $itemGroups;

    public function mount()
    {
        $this->itemGroups = ItemGroup::all();
    }

    public function submit()
    {
        $this->validate([
            'name' => 'required',
        ]);

        ItemGroup::create([
            'name' => $this->name,
        ]);
    }


    public function render()
    {
        return view('livewire.create-item-group');
    }

    
}
