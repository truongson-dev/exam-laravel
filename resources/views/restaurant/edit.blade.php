@extends('layouts.app')

@section('title', 'Sửa Món Ăn — FoodViet')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">

                <h2 class="section-title">✏️ Cập Nhật Món Ăn</h2>

                @if($errors->any())
                    <div class="alert alert-danger alert-validation alert-dismissible fade show" role="alert">
                        <h5 class="alert-heading"><i class="fas fa-exclamation-triangle me-2"></i>Có lỗi xảy ra!</h5>
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="form-card">
                    <form action="{{ route('restaurant.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="form-label">Tên Món Ăn <span class="required">*</span></label>
                            <input type="text" name="name" value="{{ old('name', $item->name) }}"
                                class="form-control @error('name') is-invalid @enderror">
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Danh Mục <span class="required">*</span></label>
                            <select name="category" class="form-select @error('category') is-invalid @enderror">
                                @foreach($categories as $cat)
                                    <option value="{{ $cat }}" {{ old('category', $item->category) == $cat ? 'selected' : '' }}>
                                        {{ $cat }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Giá Tiền (VNĐ) <span class="required">*</span></label>
                            <div class="input-group">
                                <input type="number" name="price" value="{{ old('price', $item->price) }}"
                                    class="form-control @error('price') is-invalid @enderror" min="1000">
                                <span class="input-group-text">đ</span>
                                @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Mô Tả</label>
                            <textarea name="description" rows="4"
                                class="form-control @error('description') is-invalid @enderror">{{ old('description', $item->description) }}</textarea>
                            @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Hình Ảnh</label>
                            @if($item->image)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="Ảnh hiện tại"
                                        style="max-height:120px; border-radius:8px;">
                                    <small class="text-muted d-block">Ảnh hiện tại — tải lên ảnh mới để thay thế.</small>
                                </div>
                            @endif
                            <input type="file" name="image" accept="image/*"
                                class="form-control @error('image') is-invalid @enderror">
                            @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Trạng Thái <span class="required">*</span></label>
                            <select name="status" class="form-select @error('status') is-invalid @enderror">
                                <option value="1" {{ old('status', $item->status) == 1 ? 'selected' : '' }}>✅ Còn hàng
                                </option>
                                <option value="0" {{ old('status', $item->status) == 0 ? 'selected' : '' }}>❌ Hết hàng
                                </option>
                            </select>
                            @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <hr class="my-4">
                        <div class="d-flex gap-3">
                            <button type="submit" class="btn btn-warning btn-lg px-5">
                                <i class="fas fa-save me-2"></i>Cập Nhật
                            </button>
                            <a href="{{ route('restaurant.show', $item->id) }}"
                                class="btn btn-outline-secondary btn-lg">Hủy</a>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection