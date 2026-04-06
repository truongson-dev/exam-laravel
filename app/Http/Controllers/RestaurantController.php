<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Http\Requests\RestaurantRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RestaurantController extends Controller
{
    /**
     * Home page — show items grouped by category
     */
    public function index()
    {
        $categories = Restaurant::categories();

        $byCategory = [];
        foreach ($categories as $cat) {
            $byCategory[$cat] = Restaurant::byCategory($cat)->available()->get();
        }

        return view('restaurant.index', compact('byCategory', 'categories'));
    }

    /**
     * Show items for a single category
     */
    public function category(string $category)
    {
        $items = Restaurant::byCategory($category)->available()->paginate(8);
        $categories = Restaurant::categories();

        return view('restaurant.category', compact('items', 'category', 'categories'));
    }

    /**
     * Detail page for one item
     */
    public function show(int $id)
    {
        $item = Restaurant::findOrFail($id);
        $related = Restaurant::byCategory($item->category)
            ->where('id', '!=', $id)
            ->available()
            ->limit(4)
            ->get();

        return view('restaurant.show', compact('item', 'related'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        $categories = Restaurant::categories();
        return view('restaurant.create', compact('categories'));
    }

    /**
     * Store new item (uses RestaurantRequest for validation)
     */
    public function store(RestaurantRequest $request)
    {
        $data = $request->validated();

        // Handle image upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $data['image'] = $path;
        }

        Restaurant::create($data);

        return redirect()->route('restaurant.index')
            ->with('success', '✅ Thêm món ăn thành công!');
    }

    /**
     * Show edit form
     */
    public function edit(int $id)
    {
        $item = Restaurant::findOrFail($id);
        $categories = Restaurant::categories();
        return view('restaurant.edit', compact('item', 'categories'));
    }

    /**
     * Update existing item
     */
    public function update(RestaurantRequest $request, int $id)
    {
        $item = Restaurant::findOrFail($id);
        $data = $request->validated();

        if ($request->hasFile('image')) {
            // Delete old image if stored locally
            if ($item->image) {
                Storage::disk('public')->delete($item->image);
            }
            $data['image'] = $request->file('image')->store('images', 'public');
        }

        $item->update($data);

        return redirect()->route('restaurant.index')
            ->with('success', '✅ Cập nhật món ăn thành công!');
    }

    /**
     * Delete item
     */
    public function destroy(int $id)
    {
        $item = Restaurant::findOrFail($id);

        if ($item->image) {
            Storage::disk('public')->delete($item->image);
        }

        $item->delete();

        return redirect()->route('restaurant.index')
            ->with('success', '🗑️ Đã xóa món ăn.');
    }
}