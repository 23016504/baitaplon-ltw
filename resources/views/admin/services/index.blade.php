<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('QUẢN LÝ DỊCH VỤ THÀNH PHẦN') }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="bg-white p-6 shadow-sm sm:rounded-lg border h-fit">
            <h3 class="text-lg font-bold text-gray-700 mb-4">Thêm dịch vụ mới</h3>
            <form action="{{ route('admin.services.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Tên dịch vụ:</label>
                    <input type="text" name="name" required placeholder="Ví dụ: Khách sạn Mường Thanh" class="w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Loại dịch vụ:</label>
                    <select name="type" required class="w-full border-gray-300 rounded-md shadow-sm">
                        <option value="hotel">Khách sạn (Hotel)</option>
                        <option value="transport">Di chuyển (Transport)</option>
                        <option value="sightseeing">Tham quan (Sightseeing)</option>
                        <option value="tour">Chuyến đi hướng dẫn (Tour)</option>
                    </select>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Giá dịch vụ (VND):</label>
                    <input type="number" name="price" min="0" required placeholder="Ví dụ: 500000" class="w-full border-gray-300 rounded-md shadow-sm">
                </div>
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition">Lưu dịch vụ</button>
            </form>
        </div>

        <div class="bg-white p-6 shadow-sm sm:rounded-lg border md:col-span-2">
            <h3 class="text-lg font-bold text-gray-700 mb-4">Danh sách dịch vụ</h3>
            @if(session('success'))
                <div class="bg-green-100 text-green-800 p-3 rounded mb-4 text-sm">{{ session('success') }}</div>
            @endif
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-100 border-b">
                        <th class="p-3 font-semibold text-sm text-gray-600">Tên dịch vụ</th>
                        <th class="p-3 font-semibold text-sm text-gray-600">Loại</th>
                        <th class="p-3 font-semibold text-sm text-gray-600">Giá tiền</th>
                        <th class="p-3 font-semibold text-sm text-gray-600">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($services as $service)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-3 text-sm text-gray-800 font-medium">{{ $service->name }}</td>
                            <td class="p-3 text-sm text-gray-500"><span class="px-2 py-1 bg-gray-200 rounded text-xs">{{ ucfirst($service->type) }}</span></td>
                            <td class="p-3 text-sm font-bold text-blue-600">{{ number_format($service->price) }}đ</td>
                            <td class="p-3 text-sm">
                                <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" onsubmit="return confirm('Xóa dịch vụ này?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 font-semibold">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="p-3 text-center text-gray-400 text-sm">Chưa có dịch vụ nào!</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>