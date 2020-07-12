@extends('mail.layouts.master')
@section('content')
    <h2>Шеф, поступил новый отзыв. Может стоить ответить?</h2>
    <div style="display: flex">
        <p style="font-weight: 600; width: 70px">Имя: </p>
        <p>{{ $review->name }}</p>
    </div>

    <div style="display: flex">
        <p style="font-weight: 600; width: 70px">Продукт: </p>
        <p>
            <a href="{{ !is_null($review->product_id) ? route('product', ['category' => $review->product->category->slug, 'product' => $review->product->slug]) : route('getReviews') }}">
                {{ !is_null($review->product_id) ? $review->product->name : 'О магазине' }}
            </a>
        </p>
    </div>

    <div style="display: flex">
        <p style="font-weight: 600; width: 70px">Создан: </p>
        <p>{{ $review->created_at }}</p>
    </div>

    <div>
        <p style="font-weight: 600">Отзыв: </p>
        <p>{{ $review->review }}</p>
    </div>

@endsection

