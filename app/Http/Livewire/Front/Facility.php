<?php

namespace App\Http\Livewire\Front;

use App\Models\Category;
use App\Models\Facility as ModelsFacility;
use Livewire\Component;
use Livewire\WithPagination;

class Facility extends Component
{
    use WithPagination;
    public $filterCategory = null;

    public function updatedFilterCategory() {
        $this->resetPage();
    }

    public function render()
    {
        $currentCat = $this->filterCategory;
        return view('livewire.front.facility', [
            'categories' => Category::all(),
            'facilities' => ModelsFacility::where(function ($q) use($currentCat) {
                if($currentCat) {
                    $q->where('category_id', 'like', '%' . $currentCat . '%');
                }
            })->paginate(10),
        ]);
    }

    public function clearFilter() {
        $this->filterCategory = null;
    }
}
