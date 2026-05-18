<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Combo;
use App\Models\Service;
use Illuminate\Http\Request;

class ComboController extends Controller
{
    // 1. Hiển thị trang quản lý Combo
    public function index()
    {
        $combos = Combo::with('services')->get(); // Lấy kèm quan hệ để tối ưu câu lệnh SQL
        $services = Service::all(); // Lấy dịch vụ thô thẩy vào form checkbox
        return view('admin.combos.index', compact('combos', 'services'));
    }

    // 2. Xử lý lưu Combo mới + Upload ảnh + Gắn dịch vụ thành phần
    public function store(Request $request)
    {
        // Validation đầu vào nghiêm ngặt
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Tối đa 2MB
            'services' => 'required|array', // Bắt buộc phải tích chọn ít nhất 1 dịch vụ
        ]);

        // Xử lý Upload hình ảnh lưu vào thư mục public/uploads
        $imageName = time() . '.' . $request->image->extension();  
        $request->image->move(public_path('uploads'), $imageName);

        // Tạo bản ghi Combo mới
        $combo = Combo::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imageName,
        ]);

        // Gắn các ID dịch vụ được tích chọn vào bảng trung gian combo_service
        $combo->services()->attach($request->services); 

        return redirect()->route('admin.combos.index')->with('success', 'Tạo Combo du lịch thành công!');
    }

    // 3. Xóa Combo
    public function destroy($id)
    {
        $combo = Combo::findOrFail($id);
        
        // Gỡ liên kết bảng trung gian trước khi xóa để tránh lỗi khóa ngoại
        $combo->services()->detach();
        $combo->delete();

        return redirect()->route('admin.combos.index')->with('success', 'Xóa Combo thành công!');
    }

    // Giữ các hàm trống mặc định của Resource
    public function create() {}
    public function show($id) {}
    public function edit($id) {}
    public function update(Request $request, $id) {}
}