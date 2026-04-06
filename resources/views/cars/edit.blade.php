@extends('layouts.app')

@section('title', 'Chỉnh sửa xe')

@section('content')
<div class="max-w-3xl mx-auto">
    <nav class="flex mb-8" aria-label="Breadcrumb">
        <ol class="flex items-center space-x-4">
            <li><a href="{{ route('cars.index') }}" class="text-sm font-medium text-slate-500 hover:text-indigo-600 transition-colors">Danh sách xe</a></li>
            <li>
                <div class="flex items-center">
                    <svg class="h-5 w-5 text-slate-300 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                    <span class="ml-4 text-sm font-bold text-slate-900">Sửa thông tin: <span class="text-indigo-600">{{ $car->model }}</span></span>
                </div>
            </li>
        </ol>
    </nav>

    <div class="bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden">
        <div class="px-8 py-6 luxury-gradient flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-white flex items-center">
                    <svg class="h-6 w-6 mr-3 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Cập nhật xe #{{ $car->id }}
                </h2>
                <p class="text-slate-300 text-sm mt-1 italic">Bạn có thể chọn tải lên ảnh mới để thay thế ảnh hiện tại.</p>
            </div>
            <div class="h-20 w-20 bg-white/20 rounded-xl p-1 backdrop-blur-sm border border-white/30 overflow-hidden shadow-lg">
                 <img src="/images/{{ $car->image }}" class="h-full w-full object-cover rounded-lg" alt="Preview current">
            </div>
        </div>

        <form action="{{ route('cars.update', $car->id) }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Model -->
                <div class="space-y-2">
                    <label for="model" class="block text-sm font-semibold text-slate-700">Tên đời xe (Model)</label>
                    <input type="text" name="model" id="model" value="{{ $car->model }}" placeholder="Ví dụ: Honda Civic 2024" 
                        class="w-full px-4 py-2 rounded-lg border border-slate-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all outline-none" required>
                </div>

                <!-- Produced On -->
                <div class="space-y-2">
                    <label for="produced_on" class="block text-sm font-semibold text-slate-700">Ngày sản xuất</label>
                    <input type="date" name="produced_on" id="produced_on" value="{{ $car->produced_on }}" 
                        class="w-full px-4 py-2 rounded-lg border border-slate-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all outline-none" required>
                </div>
            </div>

            <!-- Description -->
            <div class="space-y-2">
                <label for="description" class="block text-sm font-semibold text-slate-700">Mô tả chi tiết</label>
                <textarea name="description" id="description" rows="4" placeholder="Thông số kỹ thuật, tình trạng xe..." 
                    class="w-full px-4 py-2 rounded-lg border border-slate-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all outline-none" required>{{ $car->description }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Image File -->
                <div class="space-y-2">
                    <label for="image_file" class="block text-sm font-semibold text-slate-700">Tải lên ảnh mới (Tùy chọn)</label>
                    <div class="relative">
                        <input type="file" name="image_file" id="image_file" 
                            class="w-full px-4 py-2 rounded-lg border border-slate-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 outline-none">
                        <p class="text-[10px] text-slate-400 mt-1">Để trống nếu muốn giữ nguyên ảnh hiện tại ({{ $car->image }})</p>
                    </div>
                </div>

                <!-- Manufacturer -->
                <div class="space-y-2">
                    <label for="mf_id" class="block text-sm font-semibold text-slate-700">Hãng sản xuất</label>
                    <select name="mf_id" id="mf_id" 
                        class="w-full px-4 py-2 rounded-lg border border-slate-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all bg-white outline-none font-medium" required>
                        @foreach($mfs as $mf)
                            <option value="{{ $mf->id }}" {{ $car->mf_id == $mf->id ? 'selected' : '' }}>{{ $mf->mf_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="pt-6 border-t border-slate-100 flex items-center justify-end space-x-4">
                <a href="{{ route('cars.index') }}" class="px-6 py-2 rounded-lg text-sm font-semibold text-slate-500 hover:text-slate-700 hover:bg-slate-100 transition-colors">Hủy & Quay lại</a>
                <button type="submit" class="px-8 py-2 bg-emerald-600 rounded-lg text-sm font-bold text-white hover:bg-emerald-700 shadow-lg hover:shadow-emerald-200 transition-all">Lưu thay đổi</button>
            </div>
        </form>
    </div>
</div>
@endsection
