<?php

namespace App\Livewire\Admin\Equipment;

use App\Models\Equipment;
use Illuminate\Database\QueryException;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Index extends Component
{
    use WithFileUploads;
    use WithPagination;

    // Form fields
    public $name = '';
    public $description = '';
    public $price = '';
    public $stock = '';
    public $category = '';
    public $picture;

    // Form state
    public $showForm = false;
    public $editingId = null;

    // Delete state
    public $deletingId = null;
    public $deletingName = '';

    // Filters
    public $search = '';
    public $categoryFilter = '';
    public $stockFilter = '';
    public $existingPicture = null;
    /*
    |--------------------------------------------------------------------------
    | Filter Events
    |--------------------------------------------------------------------------
    */

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedCategoryFilter()
    {
        $this->resetPage();
    }

    public function updatedStockFilter()
    {
        $this->resetPage();
    }

    public function clearFilters()
    {
        $this->reset([
            'search',
            'categoryFilter',
            'stockFilter',
        ]);

        $this->resetPage();
    }

    /*
    |--------------------------------------------------------------------------
    | Create
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $this->resetForm();

        $this->showForm = true;
    }

    public function store()
    {
        $validated = $this->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'required',
                'string',
            ],

            'price' => [
                'required',
                'numeric',
                'min:0',
            ],

            'stock' => [
                'required',
                'integer',
                'min:0',
            ],

            'category' => [
                'required',
                'string',
                'max:255',
            ],

            'picture' => [
                'nullable',
                'image',
                'max:2048',
            ],
        ]);

        if ($this->picture) {
            $validated['picture'] = $this->picture->store(
                'equipment',
                'public'
            );
        }

        Equipment::create($validated);

        $this->resetForm();

        session()->flash(
            'success',
            'Equipment created successfully.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Edit / Update
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $this->resetValidation();

        $equipment = Equipment::findOrFail($id);

        $this->editingId = $equipment->id;

        $this->name = $equipment->name;
        $this->description = $equipment->description;
        $this->price = $equipment->price;
        $this->stock = $equipment->stock;
        $this->category = $equipment->category;
        $this->existingPicture = $equipment->picture;

        $this->showForm = true;
    }

    public function update()
    {
        $validated = $this->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'required',
                'string',
            ],

            'price' => [
                'required',
                'numeric',
                'min:0',
            ],

            'stock' => [
                'required',
                'integer',
                'min:0',
            ],

            'category' => [
                'required',
                'string',
                'max:255',
            ],

            'picture' => [
                'nullable',
                'image',
                'max:2048',
            ],
        ]);

        $equipment = Equipment::findOrFail(
            $this->editingId
        );

        if ($this->picture) {
            $validated['picture'] = $this->picture->store(
                'equipment',
                'public'
            );
        } else {
            unset($validated['picture']);
        }

        $equipment->update($validated);

        $this->resetForm();

        session()->flash(
            'success',
            'Equipment updated successfully.'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Delete
    |--------------------------------------------------------------------------
    */

    public function confirmDelete($id)
    {
        $equipment = Equipment::findOrFail($id);

        $this->deletingId = $equipment->id;
        $this->deletingName = $equipment->name;
    }

    public function cancelDelete()
    {
        $this->reset([
            'deletingId',
            'deletingName',
        ]);
    }

    public function delete($id)
    {
        try {
            $equipment = Equipment::findOrFail($id);

            $equipment->delete();

            $this->reset([
                'deletingId',
                'deletingName',
            ]);

            session()->flash(
                'success',
                'Equipment deleted successfully.'
            );

            /*
             * Useful when deleting the final item on the
             * current pagination page.
             */
            $this->resetPage();

        } catch (QueryException $e) {
            $this->reset([
                'deletingId',
                'deletingName',
            ]);

            session()->flash(
                'error',
                'This equipment cannot be deleted because it has rental history.'
            );
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Form Helpers
    |--------------------------------------------------------------------------
    */

    public function cancelForm()
    {
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->reset([
            'name',
            'description',
            'price',
            'stock',
            'category',
            'picture',
            'editingId',
            'existingPicture',
        ]);

        $this->showForm = false;

        $this->resetValidation();
    }

    /*
    |--------------------------------------------------------------------------
    | Render
    |--------------------------------------------------------------------------
    */

    public function render()
    {
        $equipment = Equipment::query()

            /*
             * PostgreSQL's ILIKE gives us
             * case-insensitive searching.
             */
            ->when($this->search, function ($query) {
                $search = trim($this->search);

                $query->where(function ($query) use ($search) {
                    $query
                        ->where(
                            'name',
                            'ilike',
                            "%{$search}%"
                        )
                        ->orWhere(
                            'description',
                            'ilike',
                            "%{$search}%"
                        )
                        ->orWhere(
                            'category',
                            'ilike',
                            "%{$search}%"
                        );
                });
            })

            ->when(
                $this->categoryFilter,
                function ($query) {
                    $query->where(
                        'category',
                        $this->categoryFilter
                    );
                }
            )

            ->when(
                $this->stockFilter === 'in_stock',
                function ($query) {
                    $query->where('stock', '>', 0);
                }
            )

            ->when(
                $this->stockFilter === 'low_stock',
                function ($query) {
                    $query->whereBetween(
                        'stock',
                        [1, 5]
                    );
                }
            )

            ->when(
                $this->stockFilter === 'out_of_stock',
                function ($query) {
                    $query->where('stock', 0);
                }
            )

            ->latest()
            ->paginate(10);

        /*
         * Get the currently existing category names
         * for the category dropdown.
         */
        $categories = Equipment::query()
            ->whereNotNull('category')
            ->where('category', '!=', '')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return view(
            'livewire.admin.equipment.index',
            [
                'equipment' => $equipment,
                'categories' => $categories,
            ]
        );
    }
}