<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('QUẢN LÝ DỊCH VỤ THÀNH PHẦN') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start">
                
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800 mb-5 pb-2 border-b border-gray-100 flex items-center">
                        <span class="w-2 h-5 bg-blue-600 rounded-full mr-2"></span>
                        Thêm dịch vụ mới
                    </h3>
                    
                    <form action="{{ route('admin.services.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-gray-700 text-sm font-semibold mb-2">Tên dịch vụ:</label>
                            <input type="text" name="name" required placeholder="Ví dụ: Khách sạn Mường Thanh" 
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition duration-200 shadow-sm text-sm">
                        </div>
                        
                        <div>
                            <label class="block text-gray-700 text-sm font-semibold mb-2">Loại dịch vụ:</label>
                            <select name="type" required 
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition duration-200 shadow-sm text-sm">
                                <option value="hotel"> Khách sạn (Hotel)</option>
                                <option value="transport"> Di chuyển (Transport)</option>
                                <option value="sightseeing"> Tham quan (Sightseeing)</option>
                                <option value="tour"> Chuyến đi hướng dẫn (Tour)</option>
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-gray-700 text-sm font-semibold mb-2">Giá dịch vụ (VND):</label>
                            <input type="number" name="price" min="0" required placeholder="Ví dụ: 500000" 
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition duration-200 shadow-sm text-sm">
                        </div>
                        
                        <button type="submit" 
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 px-4 rounded-lg shadow-sm hover:shadow transition duration-200 flex justify-center items-center gap-2 text-sm mt-2">
                             Lưu dịch vụ
                        </button>
                    </form>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 md:col-span-2">
                    <h3 class="text-lg font-bold text-gray-800 mb-5 pb-2 border-b border-gray-100 flex items-center">
                        <span class="w-2 h-5 bg-green-500 rounded-full mr-2"></span>
                        Danh sách dịch vụ hiện có
                    </h3>
                    
                    @if(session('success'))
                        <div class="bg-green-50 text-green-700 p-4 rounded-lg mb-4 text-sm font-medium border border-green-100 flex items-center">
                             {{ session('success') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto rounded-lg border border-gray-100">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-50 border-b border-gray-100">
                                    <th class="p-4 font-semibold text-xs text-gray-500 uppercase tracking-wider">Tên dịch vụ</th>
                                    <th class="p-4 font-semibold text-xs text-gray-500 uppercase tracking-wider">Loại</th>
                                    <th class="p-4 font-semibold text-xs text-gray-500 uppercase tracking-wider">Giá tiền</th>
                                    <th class="p-4 font-semibold text-xs text-gray-500 uppercase tracking-wider text-center">Hành động</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($services as $service)
                                    <tr class="hover:bg-gray-50/80 transition duration-150">
                                        <td class="p-4 text-sm text-gray-900 font-semibold">{{ $service->name }}</td>
                                        <td class="p-4 text-sm">
                                            @if($service->type == 'hotel')
                                                <span class="px-2.5 py-1 bg-amber-50 text-amber-700 border border-amber-100 rounded-full text-xs font-medium"> Khách sạn</span>
                                            @elseif($service->type == 'transport')
                                                <span class="px-2.5 py-1 bg-purple-50 text-purple-700 border border-purple-100 rounded-full text-xs font-medium"> Di chuyển</span>
                                            @elseif($service->type == 'sightseeing')
                                                <span class="px-2.5 py-1 bg-teal-50 text-teal-700 border border-teal-100 rounded-full text-xs font-medium"> Tham quan</span>
                                            @else
                                                <span class="px-2.5 py-1 bg-blue-50 text-blue-700 border border-blue-100 rounded-full text-xs font-medium"> Tour</span>
                                            @endif
                                        </td>
                                        <td class="p-4 text-sm font-bold text-blue-600">{{ number_format($service->price) }}đ</td>
                                        <td class="p-4 text-sm text-center">
                                            <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa dịch vụ này không?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center text-red-600 hover:text-red-700 bg-red-50 hover:bg-red-100 px-3 py-1.5 rounded-lg font-medium text-xs transition duration-150">
                                                    🗑️ Xóa
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="p-8 text-center text-gray-400 text-sm">
                                            📭 Chưa có dịch vụ nào được thêm vào hệ thống!
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>