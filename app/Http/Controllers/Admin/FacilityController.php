<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFacilityRequest;
use App\Models\Category;
use App\Models\Facility;
use App\Models\FacilityImage;
use RahulHaque\Filepond\Facades\Filepond;
use Money\Parser\IntlMoneyParser;
use Money\Currencies\ISOCurrencies;


class FacilityController extends Controller
{

    public function index() {
        $facilities = Facility::with('category')->paginate(10);

        return view('admin.facilities.index', compact('facilities'));
    }

    public function create() {
        $categories = Category::all();

        return view('admin.facilities.create', compact('categories'));
    }

    public function store(StoreFacilityRequest $request) {
        $validated = $request->validated();

        $currencies = new ISOCurrencies();
        $numberFormatter = new \NumberFormatter('en_US', \NumberFormatter::CURRENCY);
        $moneyParser = new IntlMoneyParser($numberFormatter, $currencies);
        $money = $moneyParser->parse($validated['price']);

        $facility = Facility::create([
            'name' => $validated['name'],
            'category_id' => isset($validated['category_id']) ? $validated['category_id'] : null,
            'price' => $money->getAmount(),
            'content' => $validated['content'],
        ]);

        Filepond::field($request->file)->validate(['file.*' => 'required|image|max:3000']);
        $facilityName = 'facility-' . $facility->slug . '-' . uniqid();

        $fileInfos = Filepond::field($request->file)
            ->moveTo(storage_path(('app/public/facilities/')) . $facilityName);

        foreach($fileInfos as $image) {
            $allImagesPathes[]['path'] = $image['basename'];
        }

        $facility->images()->createMany($allImagesPathes);

        return redirect()->route('facilities.index')->with('message', 'Facility added.');
    }

    public function edit(Facility $facility) {
        $categories = Category::all();
        $images = $facility->images()->get();

        return view('admin.facilities.edit', compact('facility', 'categories', 'images'));
    }

    public function update(StoreFacilityRequest $request, Facility $facility) {
        $validated = $request->validated();

        $currencies = new ISOCurrencies();
        $numberFormatter = new \NumberFormatter('en_US', \NumberFormatter::CURRENCY);
        $moneyParser = new IntlMoneyParser($numberFormatter, $currencies);
        $money = $moneyParser->parse($validated['price']);

        $facility->update([
            'name' => $validated['name'],
            'category_id' => isset($validated['category_id']) ? $validated['category_id'] : null,
            'price' => $money->getAmount(),
            'content' => $validated['content'],
        ]);

        if($request->has('file')) {
            Filepond::field($request->file)->validate(['file.*' => 'image|max:3000']);
            $facilityName = 'facility-' . $facility->slug . '-' . uniqid();

            $fileInfos = Filepond::field($request->file)
                ->moveTo(storage_path(('app/public/facilities/')) . $facilityName);

            foreach($fileInfos as $image) {
                $allImagesPathes[]['path'] = $image['basename'];
            }

            $facility->images()->createMany($allImagesPathes);
        }

        return back()->with('message', 'Facility updated.');
    }

    public function destroy(Facility $facility) {
        $facility->images()->delete();

        $images = FacilityImage::where('facility_id', $facility->id)->get();
        foreach($images as $image) {
            @unlink(storage_path(('app/public/facilities/')) . $image['path']);
        }
        $facility->delete();
        return redirect()->back()->with('message', 'Facility Has Been Deleted.');
    }
}
