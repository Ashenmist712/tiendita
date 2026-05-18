@extends('layouts.app')

@section('content')


<div class="category-header">
    <h1 class="category-title">{{ $category->nombre }}</h1>
    <p class="category-desc">{{ $category->descripcion ?? 'Explora todos los productos disponibles en esta categoría.' }}</p>
</div>

@if($products->count() > 0)
    <div class="products-grid">
        @foreach($products as $product)
            <div style="position: relative;">
                <a href="{{ route('shop.show', $product->id) }}" class="product-card">
                    <div class="product-image">
                        <img src="{{ $product->imagen }}" alt="{{ $product->nombre }}">
                    </div>
                    <div class="product-info">
                        <h3 class="product-title">{{ $product->nombre }}</h3>
                        <p class="product-desc">{{ Str::limit($product->descripcion, 80) }}</p>
                        <div class="product-footer">
                            <span class="product-price">${{ number_format($product->precio, 2) }}</span>
                            <div data-form-target="form-{{ $product->id }}" class="add-to-cart-btn">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                            </div>
                        </div>
                    </div>
                </a>
                <!-- Hidden form for add to cart -->
                <form id="form-{{ $product->id }}" action="{{ route('cart.add') }}" method="POST" style="display: none;">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                </form>
            </div>
        @endforeach
    </div>
    
    <div class="pagination-wrapper">
        {{ $products->links() }}
    </div>
@else
    <div style="text-align: center; padding: 6rem; color: var(--text-secondary);">
        <h3>No hay productos en esta categoría.</h3>
        <a href="{{ route('shop.index') }}" style="color: var(--accent-primary); text-decoration: none; margin-top: 1rem; display: inline-block;">Volver a la tienda</a>
    </div>
@endif

@endsection
