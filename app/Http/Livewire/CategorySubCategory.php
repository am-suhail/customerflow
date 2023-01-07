<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\SubCategory;
use Livewire\Component;

class CategorySubCategory extends Component
{
    public $type;

    public $categories, $subcategories;

    public $selectedCategory = null;
    public $selectedSubCategory = null;

    /**
     * Mount method for the data
     *
     * @return response()
     */
    public function mount($selectedSubCategory = null, $type = 1)
    {
        $this->categories = Category::where('type', $type)
            ->get();
        $this->subcategories = collect();
        $this->selectedSubCategory = $selectedSubCategory;

        if (!is_null($selectedSubCategory)) {
            $subcategory = SubCategory::with('category')->find($selectedSubCategory);
            if ($subcategory) {
                $this->subcategories = SubCategory::where('category_id', $subcategory->category_id)->get();
                $this->selectedCategory = $subcategory->category_id;
            }
        }
    }

    public function render()
    {
        return view('livewire.category-sub-category');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function updatedSelectedCategory($category)
    {
        if (!is_null($category)) {
            $this->subcategories = SubCategory::where('category_id', $category)->get();
        }
    }
}
