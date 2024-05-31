<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Category;

class ProductManager extends Component
{
    use WithFileUploads;

    public $products, $categories, $name, $description, $price, $image, $product_id, $selectedCategories = [], $deleteProductId;
    public $isOpen = false;
    public $isDeleteModalOpen = false;

    protected $rules = [
        'name' => 'required',
        'price' => 'required',
        'selectedCategories' => 'required|array|min:1',        
        'image' => 'nullable|image|max:2048',
    ];

    protected $messages = [
        'selectedCategories' => "The categpry field is required."
    ];

    public function render()
    {
        $this->products = Product::with('categories')->get();
        $this->categories = Category::all();

        return view('livewire.product-manager');
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
        $this->description = '';
        $this->price = '';        
        $this->image = null;
        $this->product_id = '';
        $this->selectedCategories = [];
    }

    public function store()
    {
        $this->validate();

        $product = Product::find($this->product_id);

        if ($this->image) {
            $imagePath = $this->image->store('images', 'public');
        }

        if (!$product) {
            $product = Product::create([
                'name' => $this->name,
                'description' => $this->description,
                'price' => $this->price,
                'image' => $imagePath ?? null,
            ]);
        } else {
            $product->update([
                'name' => $this->name,
                'description' => $this->description,
                'price' => $this->price,
                'image' => $imagePath ?? null,
            ]);
        }
        
        $product->categories()->sync($this->selectedCategories);

        session()->flash('message', 
            $this->product_id ? 'Product Updated Successfully.' : 'Product Created Successfully.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $this->product_id = $id;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->selectedCategories = $product->categories->pluck('id')->toArray();        
        $this->image = null;

        $this->openModal();
    }

    public function confirmDelete($id)
    {
        $this->deleteProductId = $id;
        $this->isDeleteModalOpen = true;
    }

    public function deleteProduct()
    {
        $product = Product::findOrFail($this->deleteProductId)->delete();

        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        $this->isDeleteModalOpen = false;
        session()->flash('message', 'Product Deleted Successfully.');
    }

    // public function delete($id)
    // {
    //     Product::find($id)->delete();
    //     session()->flash('message', 'Product Deleted Successfully.');
    // }
}
