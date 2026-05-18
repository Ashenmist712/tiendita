@extends('layouts.app')

@section('content')


<div class="checkout-container">
    <div class="checkout-form">
        <h1 class="checkout-title">Datos de Envío y Pago</h1>
        <p style="color: var(--text-secondary); margin-bottom: 2rem;">Completa tus datos para procesar el pedido.</p>
        
        <form action="#" method="POST">
            @csrf
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                <div class="form-group">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" required placeholder="Juan">
                </div>
                <div class="form-group">
                    <label class="form-label">Apellidos</label>
                    <input type="text" name="apellidos" class="form-control" required placeholder="Pérez">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Correo Electrónico</label>
                <input type="email" name="email" class="form-control" required placeholder="juan@ejemplo.com">
            </div>

            <div class="form-group">
                <label class="form-label">Teléfono</label>
                <input type="tel" name="telefono" class="form-control" required placeholder="555-123-4567">
            </div>

            <div class="form-group">
                <label class="form-label">Dirección Completa</label>
                <input type="text" name="direccion" class="form-control" required placeholder="Av. Principal 123, Col. Centro">
            </div>

            <h3 style="margin: 2rem 0 1rem; font-size: 1.5rem;">Método de Pago</h3>
            <div class="form-group">
                <select name="metodo_pago" class="form-control">
                    <option value="tarjeta">Tarjeta de Crédito / Débito</option>
                    <option value="transferencia">Transferencia Bancaria (SPEI)</option>
                    <option value="oxxo">Pago en Oxxo</option>
                </select>
            </div>

            <button type="submit" class="checkout-btn" style="margin-top: 3rem;">Confirmar Pedido</button>
        </form>
    </div>

    <div class="order-summary">
        <h3 style="font-size: 1.5rem; margin-bottom: 2rem; border-bottom: 1px solid var(--surface-border); padding-bottom: 1rem;">Tu Pedido</h3>
        
        @php $total = 0; @endphp
        @foreach($cart as $details)
            @php $total += $details['price'] * $details['quantity']; @endphp
            <div class="order-item">
                <div style="flex-grow: 1;">
                    <div style="font-weight: 600; color: var(--text-primary);">{{ $details['name'] }}</div>
                    <div style="color: var(--text-secondary); font-size: 0.9rem;">Cant: {{ $details['quantity'] }}</div>
                </div>
                <div style="font-weight: 600; color: var(--accent-primary);">
                    ${{ number_format($details['price'] * $details['quantity'], 2) }}
                </div>
            </div>
        @endforeach

        <div style="display: flex; justify-content: space-between; margin-top: 2rem; padding-top: 1rem; border-top: 1px solid var(--surface-border); font-size: 1.5rem; font-weight: 700;">
            <span>Total</span>
            <span style="color: var(--accent-primary);">${{ number_format($total, 2) }}</span>
        </div>
        
        <p style="font-size: 0.85rem; color: var(--text-secondary); margin-top: 1.5rem; text-align: center;">
            Los impuestos y gastos de envío se calcularán en el siguiente paso.
        </p>
    </div>
</div>

@endsection
