<div class="cart-overlay" id="cartOverlay"></div>

<div class="cart-sidebar" id="cartSidebar">
    <!-- Left panel (Recommendations) -->
    <div class="cart-sidebar-left">
        <div class="sidebar-title">También podría gustarte</div>
        @php
            // Obtener algunas recomendaciones al azar
            $sidebarRecs = \App\Models\Product::inRandomOrder()->take(4)->get();
        @endphp
        
        @foreach($sidebarRecs as $rec)
            <a href="{{ route('shop.show', $rec->id) }}" class="sidebar-rec-item">
                <span style="background: #fdf028; color: #111; font-size: 0.6rem; font-weight: bold; padding: 2px 6px; border-radius: 4px; position: absolute; top: 10px; left: 10px;">NUEVO</span>
                <img src="{{ $rec->imagen }}" alt="{{ $rec->nombre }}" class="sidebar-rec-img">
                <div style="font-size: 0.85rem; color: var(--text-secondary); margin-bottom: 0.2rem;">Sugerencia</div>
                <div style="font-size: 0.95rem; font-weight: 600; color: var(--text-primary); line-height: 1.2;">{{ $rec->nombre }}</div>
                <div class="sidebar-rec-price">${{ number_format($rec->precio, 2) }}</div>
            </a>
        @endforeach
    </div>

    <!-- Right panel (Cart Items) -->
    <div class="cart-sidebar-right">
        @php
            $cartItems = session('cart', []);
            $totalCount = count($cartItems);
            $cartTotal = 0;
        @endphp
        
        <div class="cart-sidebar-header">
            <div class="sidebar-title" style="margin-bottom: 0;">Tu Carrito ({{ $totalCount }} {{ $totalCount == 1 ? 'Producto' : 'Productos' }})</div>
            <button class="close-cart-btn" id="closeCartBtn">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>

        <div class="cart-sidebar-body">
            @if($totalCount > 0)
                @foreach($cartItems as $id => $details)
                    @php $cartTotal += $details['price'] * $details['quantity']; @endphp
                    <div class="cart-sidebar-item">
                        <img src="{{ $details['image'] }}" alt="{{ $details['name'] }}" class="cart-sidebar-item-img">
                        <div class="cart-sidebar-item-info">
                            <div class="cart-sidebar-item-title">{{ $details['name'] }}</div>
                            <div style="color: var(--text-secondary); font-size: 0.9rem; margin-bottom: 0.5rem;">
                                ${{ number_format($details['price'], 2) }}
                            </div>
                            
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <form action="{{ route('cart.remove') }}" method="POST" style="margin: 0;">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $id }}">
                                    <button type="submit" style="background: none; border: none; color: #f85149; font-size: 0.85rem; cursor: pointer; display: flex; align-items: center; gap: 4px;">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                        Eliminar
                                    </button>
                                </form>
                                <div style="font-size: 0.85rem; font-weight: 500;">
                                    Subtotal: ${{ number_format($details['price'] * $details['quantity'], 2) }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div style="text-align: center; color: var(--text-secondary); margin-top: 2rem;">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom: 1rem;"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                    <p>Tu carrito está vacío</p>
                </div>
            @endif
        </div>

        <div class="cart-sidebar-footer">
            <div class="cart-sidebar-total">
                <span>Total Estimado</span>
                <span style="color: var(--accent-primary);">${{ number_format($cartTotal, 2) }}</span>
            </div>
            
            <div class="cart-sidebar-buttons">
                <button type="button" class="btn-outline" id="continueShoppingBtn">Seguir comprando</button>
                @if($totalCount > 0)
                    <a href="{{ route('cart.checkout') }}" class="btn-primary" style="text-align: center;">Finalizar pedido</a>
                @else
                    <button class="btn-primary" style="opacity: 0.5; cursor: not-allowed;" disabled>Finalizar pedido</button>
                @endif
            </div>
        </div>
    </div>
</div>
