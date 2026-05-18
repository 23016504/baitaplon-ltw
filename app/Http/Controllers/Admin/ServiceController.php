<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    // 1. Hiển thị danh sách dịch vụ
    public function index()
    {
        $services = Service::all();
        return view('admin.services.index', compact('services'));
    }

    // 2. Lưu dịch vụ mới
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:tour,hotel,transport,sightseeing',
            'price' => 'required|numeric|min:0',
        ]);

        Service::create($request->all());

        return redirect()->route('admin.services.index')->with('success', 'Thêm dịch vụ thành công!');
    }

    // 3. Xóa dịch vụ
    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'Xóa dịch vụ thành công!');
    }

    // Các hàm tạm thời chưa dùng tới nhưng phải để trống để không lỗi Resource
    public function create() {}
    public function show($id) {}
    public function edit($id) {}
    public function update(Request $request, $id) {}
}