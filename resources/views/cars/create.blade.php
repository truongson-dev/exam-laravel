@extends('layouts.app')

@section('title', 'Thêm xe mới')

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
                    <span class="ml-4 text-sm font-bold text-slate-900">Thêm mới</span>
                </div>
            </li>
        </ol>
    </nav>

    <div class="bg-white rounded-2xl shadow-xl border border-slate-200 overflow-hidden">
        <div class="px-8 py-6 luxury-gradient">
            <h2 class="text-2xl font-bold text-white flex items-center">
                <svg class="h-6 w-6 mr-3 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Nhập thông tin xe mới
            </h2>
            <p class="text-slate-300 text-sm mt-1">Vui lòng điền đầy đủ các thông tin và tải ảnh lên.</p>
        </div>

        <form action="{{ route('cars.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Model -->
                <div class="space-y-2">
                    <label for="model" class="block text-sm font-semibold text-slate-700">Tên đời xe (Model)</label>
                    <input type="text" name="model" id="model" placeholder="Ví dụ: Honda Civic 2024" 
                        class="w-full px-4 py-2 rounded-lg border border-slate-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all outline-none" required>
                </div>

                <!-- Produced On -->
                <div class="space-y-2">
                    <label for="produced_on" class="block text-sm font-semibold text-slate-700">Ngày sản xuất</label>
                    <input type="date" name="produced_on" id="produced_on" 
                        class="w-full px-4 py-2 rounded-lg border border-slate-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all outline-none" required>
                </div>
            </div>

            <!-- Description -->
            <div class="space-y-2">
                <label for="description" class="block text-sm font-semibold text-slate-700">Mô tả chi tiết</label>
                <textarea name="description" id="description" rows="4" placeholder="Thông số kỹ thuật, tình trạng xe..." 
                    class="w-full px-4 py-2 rounded-lg border border-slate-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all outline-none" required></textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Image File -->
                <div class="space-y-2">
                    <label for="image_file" class="block text-sm font-semibold text-slate-700">Hình ảnh xe</label>
                    <div class="relative">
                        <input type="file" name="image_file" id="image_file" 
                            class="w-full px-4 py-2 rounded-lg border border-slate-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 outline-none" required>
                    </div>
                </div>

                <!-- Manufacturer -->
                <div class="space-y-2">
                    <label for="mf_id" class="block text-sm font-semibold text-slate-700">Hãng sản xuất</label>
                    <select name="mf_id" id="mf_id" 
                        class="w-full px-4 py-2 rounded-lg border border-slate-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all bg-white outline-none" required>
                        <option value="">Chọn hãng xe</option>
                        @foreach($mfs as $mf)
                            <option value="{{ $mf->id }}">{{ $mf->mf_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="pt-6 border-t border-slate-100 flex items-center justify-end space-x-4">
                <a href="{{ route('cars.index') }}" class="px-6 py-2 rounded-lg text-sm font-semibold text-slate-500 hover:text-slate-700 hover:bg-slate-100 transition-colors">Hủy</a>
                <button type="submit" class="px-8 py-2 bg-indigo-600 rounded-lg text-sm font-bold text-white hover:bg-indigo-700 shadow-lg hover:shadow-indigo-200 transition-all">Lưu xe & Lưu ảnh</button>
            </div>
        </form>
    </div>
</div>
@endsection
