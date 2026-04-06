@extends('layouts.app')

@section('title', $item->name . ' — FoodViet')

@section('content')
    <div class="container py-5">

        {{-- Breadcrumb --}}
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('restaurant.index') }}">Trang Chủ</a></li>
                <li class="breadcrumb-item">
                    <a href="{{ route('restaurant.category', $item->category) }}">{{ $item->category }}</a>
                </li>
                <li class="breadcrumb-item active">{{ $item->name }}</li>
            </ol>
        </nav>

        {{-- Main detail card --}}
        <div class="row g-5 align-items-start">

            {{-- Image --}}
            <div class="col-md-5">
                <img src="{{ $item->image ? asset('storage/' . $item->image) : asset('images/placeholder.jpg') }}"
                    alt="{{ $item->name }}" class="detail-img shadow">
            </div>

            {{-- Info --}}
            <div class="col-md-7">
                <span class="badge bg-danger mb-2">{{ $item->category }}</span>
                <h1 class="fw-bold">{{ $item->name }}</h1>

                <p class="price-tag my-3">{{ number_format($item->price, 0, ',', '.') }}<small>đ</small></p>

                <p class="text-muted">
                    <i class="fas fa-circle {{ $item->status ? 'text-success' : 'text-secondary' }} me-1"></i>
                    {{ $item->status ? 'Còn hàng' : 'Tạm hết' }}
                </p>

                <hr>
                <h5 class="fw-bold">Mô tả</h5>
                <p>{{ $item->description ?? 'Chưa có mô tả.' }}</p>

                <div class="d-flex gap-3 mt-4">
                    <button class="btn btn-primary btn-lg px-5">
                        <i class="fas fa-shopping-cart me-2"></i>Đặt ngay
                    </button>
                    <a href="{{ route('restaurant.category', $item->category) }}" class="btn btn-outline-secondary btn-lg">←
                        Quay lại</a>
                </div>

                {{-- Edit/Delete for admin --}}
                <div class="mt-3 d-flex gap-2">
                    <a href="{{ route('restaurant.edit', $item->id) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit me-1"></i>Sửa
                    </a>
                    <form action="{{ route('restaurant.destroy', $item->id) }}" method="POST"
                        onsubmit="return confirm('Xóa món này?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm">
                            <i class="fas fa-trash me-1"></i>Xóa
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Related items --}}
        @if($related->isNotEmpty())
            <div class="mt-5">
                <h4 class="section-title">Món khác trong {{ $item->category }}</h4>
                <div class="row g-4">
                    @foreach($related as $r)
                        <div class="col-6 col-md-3">
                            <div class="card food-card shadow-sm">
                                <a href="{{ route('restaurant.show', $r->id) }}">
                                    <img src="{{ $r->image ? asset('storage/' . $r->image) : asset('images/placeholder.jpg') }}"
                                        alt="{{ $r->name }}">
                                </a>
                                <div class="card-body">
                                    <h6 class="fw-bold mb-1">{{ $r->name }}</h6>
                                    <span class="text-danger fw-bold">{{ number_format($r->price, 0, ',', '.') }}đ</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
@endsection