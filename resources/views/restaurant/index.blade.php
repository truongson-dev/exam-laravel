@extends('layouts.app')

@section('title', 'Trang Chủ — FoodViet')

@section('content')

    {{-- HERO --}}
    <section class="hero text-center">
        <div class="container">
            <h1 class="display-4 fw-bold">Ẩm Thực Việt Nam 🍜</h1>
            <p class="lead mb-4">Khám phá các món ăn ngon, đậm đà hương vị quê hương</p>
            <a href="#menu" class="btn btn-primary btn-lg px-5">Xem Thực Đơn</a>
        </div>
    </section>

    {{-- MENU BY CATEGORY --}}
    <section id="menu" class="py-5">
        <div class="container">

            @foreach($categories as $cat)
                @if($byCategory[$cat]->isNotEmpty())
                    <div class="mb-5">
                        {{-- Category header with "See all" link --}}
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h2 class="section-title mb-0">
                                @if($cat === 'Cơm Dĩa') 🍚
                                @elseif($cat === 'Bánh mỳ') 🥖
                                @else 🍜 @endif
                                {{ $cat }}
                            </h2>
                            <a href="{{ route('restaurant.category', $cat) }}" class="btn btn-outline-danger btn-sm">
                                Xem tất cả <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>

                        <div class="row g-4">
                            @foreach($byCategory[$cat]->take(4) as $item)
                                <div class="col-6 col-md-4 col-lg-3">
                                    <div class="card food-card h-100 shadow-sm">
                                        <a href="{{ route('restaurant.show', $item->id) }}">
                                            <img src="{{ $item->image ? asset('storage/' . $item->image) : asset('images/placeholder.jpg') }}"
                                                alt="{{ $item->name }}">
                                        </a>
                                        <div class="card-body d-flex flex-column">
                                            <span class="badge mb-2 align-self-start">{{ $cat }}</span>
                                            <h6 class="card-title fw-bold">{{ $item->name }}</h6>
                                            <p class="text-muted small mb-2">{{ Str::limit($item->description, 60) }}</p>
                                            <div class="mt-auto d-flex justify-content-between align-items-center">
                                                <span class="fw-bold text-danger">
                                                    {{ number_format($item->price, 0, ',', '.') }}đ
                                                </span>
                                                <a href="{{ route('restaurant.show', $item->id) }}" class="btn btn-primary btn-sm">Chi
                                                    tiết</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endforeach

        </div>
    </section>

@endsection