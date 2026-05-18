<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('QUẢN LÝ COMBO DU LỊCH') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start">
                
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800 mb-5 pb-2 border-b border-gray-100 flex items-center">
                        <span class="w-2 h-5 bg-indigo-600 rounded-full mr-2"></span>
                        Tạo Combo mới
                    </h3>
                    
                    <form action="{{ route('admin.combos.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-gray-700 text-sm font-semibold mb-2">Tiêu đề Combo:</label>
                            <input type="text" name="title" required placeholder="Ví dụ: Combo Nha Trang 3 Ngày 2 Đêm" 
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition text-sm">
                        </div>
                        
                        <div>
                            <label class="block text-gray-700 text-sm font-semibold mb-2">Mô tả Combo:</label>
                            <textarea name="description" rows="3" required placeholder="Nhập mô tả ngắn gọn về combo..." 
                                class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition text-sm"></textarea>
                        </div>

                        <div>
                            <label class="block text-gray-700 text-sm font-semibold mb-2">Hình ảnh đại diện:</label>
                            <input type="file" name="image"  
                                class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 border border-gray-300 rounded-lg p-1.5 shadow-sm">
                        </div>
                        
                        <div>
                            <label class="block text-gray-700 text-sm font-semibold mb-2">Chọn dịch vụ tích hợp:</label>
                            <div class="space-y-2 max-h-40 overflow-y-auto p-3 border border-gray-200 rounded-lg bg-gray-50/50 shadow-inner">
                                @forelse($services as $service)
                                    <label class="flex items-center gap-2.5 p-1 hover:bg-white rounded cursor-pointer transition">
                                        <input type="checkbox" name="services[]" value="{{ $service->id }}" class="rounded text-indigo-600 focus:ring-indigo-500 border-gray-300">
                                        <span class="text-sm text-gray-700 font-medium">{{ $service->name }}</span>
                                        <span class="text-xs text-indigo-600 font-bold ml-auto">({{ number_format($service->price) }}đ)</span>
                                    </label>
                                @empty
                                    <p class="text-xs text-gray-400 text-center py-2">⚠️ Vui lòng thêm dịch vụ ở trang Dịch Vụ trước!</p>
                                @endforelse
                            </div>
                        </div>
                        
                        <button type="submit" 
                            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2.5 px-4 rounded-lg shadow-sm hover:shadow transition duration-200 flex justify-center items-center gap-2 text-sm mt-2">
                             Lưu Combo
                        </button>
                    </form>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 md:col-span-2">
                    <h3 class="text-lg font-bold text-gray-800 mb-5 pb-2 border-b border-gray-100 flex items-center">
                        <span class="w-2 h-5 bg-purple-500 rounded-full mr-2"></span>
                        Danh sách Combo hiện có
                    </h3>
                    
                    @if(session('success'))
                        <div class="bg-green-50 text-green-700 p-4 rounded-lg mb-4 text-sm font-medium border border-green-100">
                             {{ session('success') }}
                        </div>
                    @endif

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        @forelse($combos as $combo)
                            <div class="border border-gray-100 bg-gray-50/30 rounded-xl overflow-hidden shadow-sm flex flex-col justify-between hover:shadow-md transition duration-200">
                                <img src="{{ asset('uploads/' . $combo->image) }}" alt="{{ $combo->title }}" class="w-full h-40 object-cover bg-gray-200">
                                
                                <div class="p-4 flex-1 flex flex-col justify-between">
                                    <div>
                                        <h4 class="font-bold text-gray-900 text-base mb-1">{{ $combo->title }}</h4>
                                        <p class="text-gray-500 text-xs line-clamp-2 mb-3">{{ $combo->description }}</p>
                                        
                                        <div class="mb-4">
                                            <span class="text-xs font-semibold text-gray-400 block mb-1">Dịch vụ bao gồm:</span>
                                            <div class="flex flex-wrap gap-1">
                                                @forelse($combo->services as $s)
                                                    <span class="px-2 py-0.5 bg-white border border-gray-200 rounded text-[10px] text-gray-600 font-medium">✔️ {{ $s->name }}</span>
                                                @empty
                                                    <span class="text-xs text-gray-400 italic">Chưa gộp dịch vụ nào</span>
                                                @endforelse
                                            </div>
                                        </div>
                                    </div>

                                    <div class="pt-3 border-t border-gray-100 flex items-center justify-between mt-auto">
                                        <div>
                                            <span class="text-[10px] text-gray-400 block font-medium uppercase">Tổng tiền giá gốc:</span>
                                            <span class="text-base font-black text-indigo-600">{{ number_format($combo->total_price) }}đ</span>
                                        </div>
                                        
                                        <form action="{{ route('admin.combos.destroy', $combo->id) }}" method="POST" onsubmit="return confirm('Xóa combo này?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-700 bg-red-50 hover:bg-red-100 px-3 py-1.5 rounded-lg font-medium text-xs transition duration-150">
                                                🗑️ Xóa Combo
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-2 p-8 text-center text-gray-400 text-sm">
                                 Chưa có Combo du lịch nào được tạo!
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>