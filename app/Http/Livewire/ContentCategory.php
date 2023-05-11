<?php

namespace App\Http\Livewire;

use App\Models\AltCategory;
use App\Models\Category;
use App\Models\SubCategory;
use JetBrains\PhpStorm\NoReturn;
use Livewire\Component;

class ContentCategory extends Component
{
//    public $categories = [];
//    public $alts = [];
//
//    public $subs = [];
//
//    public $selectedOption;
//
//    public $selectedOptionAlt = 1;
//
//    public function mount()
//    {
//        $this->categories = Category::where('status', 1)->get();
////        $this->alts = AltCategory::where('category_id', $this->categories[0]->id)->get();
////        if ($this->alts[0]->sub()->exists()) {
////            $this->subs = $this->alts[0]->sub()->get();
////        }
//    }
//
//    public function render()
//    {
//        return view('livewire.content-category',get_defined_vars());
//    }
//
//    public function optionChanged()
//    {
//        if ($this->selectedOption != '-1') {
//            $this->alts = AltCategory::where('category_id', $this->selectedOption)->get();
//        }else{
//            $this->alts = ['sasa','sasas'];
//        }
//        $this->render();
//    }
    public $continents = [];
    public $countries = [];

    public $subs = [];

    public $selectedContinent;
    public $selectedCountry;

    public function mount()
    {
        $this->continents = Category::all();
    }

    public function render()
    {
        return view('livewire.content-category');
    }

    public function changeCategory()
    {
        if ($this->selectedContinent !== '-1') {
            $this->countries = AltCategory::where('category_id', $this->selectedContinent)->get();
        }
    }
    public function changeSub()
    {
        if ($this->selectedCountry !== '-1') {
            $this->subs = SubCategory::where('alt_category_id', $this->selectedCountry)->get();
        }
    }
}
