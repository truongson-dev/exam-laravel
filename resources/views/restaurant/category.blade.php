@extends('layouts.app')

@section('title', $category . ' — FoodViet')

@section('content')
    <div class="container py-5">

        {{-- Breadcrumb --}}
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('restaurant.index') }}">Trang Chủ</a></li>
                <li class="breadcrumb-item active">{{ $category }}</li>
            </ol>
        </nav>

        <h2 class="section-title">
            @if($category === 'Cơm Dĩa') 🍚
            @elseif($category === 'Bánh mỳ') 🥖
            @else 🍜 @endif
            {{ $category }}
            <small class="text-muted fs-6 ms-2">({{ $items->total() }} món)</small>
        </h2>

        @if($items->isEmpty())
            <div class="alert alert-warning">Chưa có món ăn nào trong danh mục này.</div>
        @else
            <div class="row g-4">
                @foreach($items as $item)
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="card food-card h-100 shadow-sm">
                            <a href="{{ route('restaurant.show', $item->id) }}">
                                <img src="{{ $item->image ? asset('storage/' . $item->image) : asset('images/placeholder.jpg') }}"
                                    alt="{{ $item->name }}">
                            </a>
                            <div class="card-body d-flex flex-column">
                                <h6 class="card-title fw-bold">{{ $item->name }}</h6>
                                <p class="text-muted small flex-grow-1">{{ Str::limit($item->description, 70) }}</p>
                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    <span class="fw-bold text-danger fs-6">
                                        {{ number_format($item->price, 0, ',', '.') }}đ
                                    </span>
                                    <a href="{{ route('restaurant.show', $item->id) }}" class="btn btn-primary btn-sm">Chi tiết</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="d-flex justify-content-center mt-5">
                {{ $items->links() }}
            </div>
        @endif

    </div>
@endsection