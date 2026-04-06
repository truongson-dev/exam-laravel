<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Mf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::with('mf')->orderBy('id', 'desc')->paginate(10);
        return view('cars.index', compact('cars'));
    }

    public function create()
    {
        $mfs = Mf::all();
        return view('cars.create', compact('mfs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'model' => 'required',
            'produced_on' => 'required|date',
            'image_file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'mf_id' => 'required'
        ]);

        $data = $request->all();

        // Xử lý upload ảnh
        if ($request->hasFile('image_file')) {
            $image = $request->file('image_file');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $data['image'] = $imageName;
        }

        Car::create($data);

        return redirect()->route('cars.index')->with('success', 'Thêm xe thành công');
    }

    public function show(string $id)
    {
        $car = Car::with('mf')->findOrFail($id);
        return view('cars.show', compact('car'));
    }

    public function edit($id)
    {
        $car = Car::findOrFail($id);
        $mfs = Mf::all();

        return view('cars.edit', compact('car', 'mfs'));
    }

    public function update(Request $request, $id)
    {
        $car = Car::findOrFail($id);

        $request->validate([
            'description' => 'required',
            'model' => 'required',
            'produced_on' => 'required|date',
            'image_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
            'mf_id' => 'required'
        ]);

        $data = $request->all();

        // Xử lý cập nhật ảnh
        if ($request->hasFile('image_file')) {
            // Xóa ảnh cũ nếu nó tồn tại và không được dùng bởi xe khác
            $oldImagePath = public_path('images/' . $car->image);
            if (File::exists($oldImagePath) && !empty($car->image)) {
                $count = Car::where('image', $car->image)->count();
                if ($count <= 1) {
                    File::delete($oldImagePath);
                }
            }

            $image = $request->file('image_file');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $data['image'] = $imageName;
        } else {
            // Nếu không upload ảnh mới, giữ nguyên tên ảnh cũ
            $data['image'] = $car->image;
        }

        $car->update($data);

        return redirect()->route('cars.index')->with('success', 'Cập nhật thành công');
    }

    public function destroy($id)
    {
        $car = Car::findOrFail($id);
        
        // Xóa ảnh vật lý nếu nó còn tồn tại và không dùng chung
        $imagePath = public_path('images/' . $car->image);
        if (!empty($car->image) && File::exists($imagePath)) {
            // Chỉ xóa nếu không có xe nào khác dùng chung ảnh này
            $others = Car::where('image', $car->image)->where('id', '!=', $car->id)->count();
            if ($others == 0) {
                File::delete($imagePath);
            }
        }

        $car->delete();

        return redirect()->route('cars.index')->with('success', 'Xóa thành công và đã dọn dẹp dữ liệu ảnh khỏi ổ đĩa');
    }
}
