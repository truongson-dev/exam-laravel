@extends('layouts.app')

@section('title', 'Thêm Món Ăn — FoodViet')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <h2 class="section-title">🍽️ Thêm Món Ăn Mới</h2>

            {{-- ===== VALIDATION ERROR SUMMARY (top of form) ===== --}}
            @if($errors->any())
            <div class="alert alert-danger alert-validation alert-dismissible fade show" role="alert">
                <h5 class="alert-heading"><i class="fas fa-exclamation-triangle me-2"></i>Có lỗi xảy ra!</h5>
                <p class="mb-1">Vui lòng kiểm tra lại các trường bên dưới:</p>
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            <div class="form-card">
                <form action="{{ route('restaurant.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{-- Name --}}
                    <div class="mb-4">
                        <label class="form-label">Tên Món Ăn <span class="required">*</span></label>
                        <input type="text" name="name" value="{{ old('name') }}"
                               class="form-control @error('name') is-invalid @enderror"
                               placeholder="VD: Cơm Sườn Nướng">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Category --}}
                    <div class="mb-4">
                        <label class="form-label">Danh Mục <span class="required">*</span></label>
                        <select name="category" class="form-select @error('category') is-invalid @enderror">
                            <option value="">-- Chọn danh mục --</option>
                            @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ old('category') == $cat ? 'selected' : '' }}>
                                {{ $cat }}
                            </option>
                            @endforeach
                        </select>
                        @error('category')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Price --}}
                    <div class="mb-4">
                        <label class="form-label">Giá Tiền (VNĐ) <span class="required">*</span></label>
                        <div class="input-group">
                            <input type="number" name="price" value="{{ old('price') }}"
                                   class="form-control @error('price') is-invalid @enderror"
                                   placeholder="VD: 35000" min="1000">
                            <span class="input-group-text">đ</span>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="mb-4">
                        <label class="form-label">Mô Tả</label>
                        <textarea name="description" rows="4"
                                  class="form-control @error('description') is-invalid @enderror"
                                  placeholder="Nhập mô tả món ăn...">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Tối đa 1000 ký tự.</small>
                    </div>

                    {{-- Image --}}
                    <div class="mb-4">
                        <label class="form-label">Hình Ảnh</label>
                        <input type="file" name="image" accept="image/*"
                               class="form-control @error('image') is-invalid @enderror"
                               id="imageInput">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Định dạng: jpg, png, webp. Tối đa 2MB.</small>
                        {{-- Preview --}}
                        <div id="preview" class="mt-2" style="display:none;">
                            <img id="previewImg" src="#" alt="Preview"
                                 style="max-height:150px; border-radius:8px; border:1px solid #ddd;">
                        </div>
                    </div>

                    {{-- Status --}}
                    <div class="mb-4">
                        <label class="form-label">Trạng Thái <span class="required">*</span></label>
                        <select name="status" class="form-select @error('status') is-invalid @enderror">
                            <option value="1" {{ old('status', '1') == '1' ? 'selected' : '' }}>✅ Còn hàng</option>
                            <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>❌ Hết hàng</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <hr class="my-4">

                    <div class="d-flex gap-3">
                        <button type="submit" class="btn btn-primary btn-lg px-5">
                            <i class="fas fa-save me-2"></i>Lưu Món Ăn
                        </button>
                        <a href="{{ route('restaurant.index') }}" class="btn btn-outline-secondary btn-lg">
                            Hủy
                        </a>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

@push('scripts')
<script>
    // Image preview
    document.getElementById('imageInput').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(ev) {
                document.getElementById('previewImg').src = ev.target.result;
                document.getElementById('preview').style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush

@endsection