@extends('layouts.app')

@section('content')


<div class="cart-container">
    <div class="cart-header" style="display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 1rem;">
        <div>
            <h1 class="cart-title">Tu Carrito</h1>
            <p style="color: var(--text-secondary)">Revisa los artículos que has seleccionado antes de proceder al pago.</p>
        </div>
        <a href="{{ route('shop.index') }}" style="color: var(--accent-primary); text-decoration: none; font-weight: 600; display: flex; align-items: center; gap: 5px; padding: 0.5rem 1rem; background: rgba(14, 165, 233, 0.1); border-radius: 50px; transition: background 0.3s;">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
            Seguir Comprando
        </a>
    </div>

    @if(session('success'))
        <div style="margin-bottom: 2rem; color: #f85149; background: rgba(248, 81, 73, 0.1); padding: 1rem; border-radius: 10px; border: 1px solid rgba(248, 81, 73, 0.3);">
             {{ session('success') }}
        </div>
    @endif

    @if(count($cart) > 0)
        <div class="cart-content">
            <div class="cart-items">
                @php $total = 0; @endphp
                @foreach($cart as $id => $details)
                    @php $total += $details['price'] * $details['quantity']; @endphp
                    <div class="cart-item">
                        <img src="{{ $details['image'] }}" class="item-img" alt="{{ $details['name'] }}">
                        <div class="item-details">
                            <h3 class="item-title">{{ $details['name'] }}</h3>
                            <div class="item-price">${{ number_format($details['price'], 2) }}</div>
                            <div class="item-quantity">
                                Cantidad: {{ $details['quantity'] }} 
                                <span>&bull;</span>
                                Subtotal: ${{ number_format($details['price'] * $details['quantity'], 2) }}
                            </div>
                        </div>
                        <form action="{{ route('cart.remove') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $id }}">
                            <button type="submit" class="remove-btn">Eliminar</button>
                        </form>
                    </div>
                @endforeach
            </div>

            <div class="cart-summary">
                <h3 class="summary-title">Resumen de Compra</h3>
                <div class="summary-row">
                    <span>Subtotal</span>
                    <span>${{ number_format($total, 2) }}</span>
                </div>
                <div class="summary-row">
                    <span>Envío</span>
                    <span>Calculado en checkout</span>
                </div>
                <div class="summary-total">
                    <span>Total Estimado</span>
                    <span style="color: var(--accent-primary)">${{ number_format($total, 2) }}</span>
                </div>
                <a href="{{ route('cart.checkout') }}" class="checkout-btn" style="text-align: center; display: block; text-decoration: none; box-sizing: border-box;">Proceder al Pago</a>
            </div>
        </div>
    @else
        <div class="cart-items empty-cart">
            <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
            <h2 style="margin-bottom: 1rem;">Tu carrito está vacío</h2>
            <p style="color: var(--text-secondary); margin-bottom: 2rem;">Parece que aún no has agregado ningún producto a tu carrito.</p>
            <a href="{{ route('shop.index') }}#productos" class="checkout-btn" style="text-decoration: none; display: inline-block; width: auto; padding: 1rem 3rem;">Explorar Productos</a>
        </div>
    @endif
</div>

@if(isset($recommended) && $recommended->count() > 0)
<div style="padding: 0 4rem 4rem; max-width: 1400px; margin: 0 auto;">
    <h2 style="font-size: 2rem; margin-bottom: 2rem; padding-top: 4rem; border-top: 1px solid var(--surface-border);">Recomendaciones para ti</h2>
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 2rem;">
        @foreach($recommended as $rel)
            <div style="background: var(--surface-color); border: 1px solid var(--surface-border); border-radius: 16px; overflow: hidden; padding: 1rem; text-align: center; transition: transform 0.3s ease; box-shadow: 0 4px 6px rgba(0,0,0,0.05);" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
                <a href="{{ route('shop.show', $rel->id) }}" style="text-decoration: none; color: inherit;">
                    <img src="{{ $rel->imagen }}" style="width: 100%; height: 200px; object-fit: cover; border-radius: 10px; margin-bottom: 1rem; background: rgba(0,0,0,0.03);">
                    <h3 style="font-size: 1.1rem; margin-bottom: 0.5rem; color: var(--text-primary);">{{ $rel->nombre }}</h3>
                    <div style="color: var(--accent-primary); font-weight: 600;">${{ number_format($rel->precio, 2) }}</div>
                </a>
            </div>
        @endforeach
    </div>
</div>
@endif

@endsection
