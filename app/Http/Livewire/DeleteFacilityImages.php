<?php

namespace App\Http\Livewire;

use App\Models\Facility;
use App\Models\FacilityImage;
use Livewire\Component;

class DeleteFacilityImages extends Component
{
    public $images = [];
    public $facility;
    public $count = null;

    public function render() {
        $this->images = FacilityImage::where('facility_id', $this->facility->id)->get();
        $this->count = 6 - count($this->images);
        return view('livewire.delete-facility-images');
    }

    public function removeImage($index)
    {
        $requestedImage = $this->images[$index];
        $facility = $this->facility;
        $currentImage = $facility->images()->where('id', $requestedImage->id)->first();

        @unlink(storage_path(('app/public/facilities/')) . $currentImage['path']);
        $currentImage->delete();

        return redirect(request()->header('Referer'));
    }
}
