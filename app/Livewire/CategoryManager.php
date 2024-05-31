<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;

class CategoryManager extends Component
{
    public $categories, $name, $category_id, $deleteCategoryId;
    public $isOpen = false;
    public $isDeleteModalOpen = false;

    protected $rules = [
        'name' => 'required',
    ];

    public function render()
    {
        $this->categories = Category::all();

        return view('livewire.category-manager');
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->category_id = '';
    }

    public function store()
    {
        $this->validate();

        $category = Category::find($this->category_id);

        if (!$category) {
            Category::create([
                'name' => $this->name,
            ]);
        } else {
            $category->update([
                'name' => $this->name,
            ]);
        }


        session()->flash('message', 
            $this->category_id ? 'Category Updated Successfully.' : 'Category Created Successfully.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $this->category_id = $id;
        $this->name = $category->name;

        $this->openModal();
    }

    public function confirmDelete($id)
    {
        $this->deleteCategoryId = $id;
        $this->isDeleteModalOpen = true;
    }

    public function deleteCategory()
    {
        Category::findOrFail($this->deleteCategoryId)->delete();
        $this->isDeleteModalOpen = false;
        session()->flash('message', 'Category Deleted Successfully.');
    }

    // public function delete($id)
    // {
    //     Category::find($id)->delete();
    //     session()->flash('message', 'Category Deleted Successfully.');
    // }
}
