<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MSI | Materiales y Servicios Industriales</title>
    <meta name="description" content="Suministramos equipos de seguridad industrial, herramientas mecánicas y eléctricas, y materiales para la industria.">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Outfit:wght@400;600;800&display=swap" rel="stylesheet">
    
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
</head>
<body>

    <nav class="navbar">
        <a href="/" class="navbar-brand">
            MSI <span>Tienda</span>
        </a>
        <ul class="nav-links">
            <li><a href="/" class="{{ request()->routeIs('shop.index') ? 'active' : '' }}">Inicio</a></li>
            <li><a href="{{ route('pages.about') }}" class="{{ request()->routeIs('pages.about') ? 'active' : '' }}">Nosotros</a></li>
            <li><a href="/#categorias">Categorías</a></li>
            <li><a href="/#productos">Productos</a></li>
        </ul>
        <div class="nav-actions" style="display: flex; align-items: center; gap: 1.5rem;">
            <a href="#" id="openCartBtn" style="position: relative; color: var(--text-primary); transition: transform 0.3s; display: flex; align-items: center; cursor: pointer;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'">
                <!-- Ícono de carrito -->
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                
                @php $cartCount = count(session('cart', [])); @endphp
                @if($cartCount > 0)
                    <!-- Contador flotante (Badge) -->
                    <span style="position: absolute; top: -5px; right: -10px; background: #f85149; color: white; border-radius: 50%; width: 20px; height: 20px; display: flex; align-items: center; justify-content: center; font-size: 0.75rem; font-weight: bold; border: 2px solid white;">
                        {{ $cartCount }}
                    </span>
                @endif
            </a>
            <a href="{{ route('admin.dashboard') }}" class="btn-primary">Admin Panel</a>
        </div>
    </nav>

    @include('partials.cart_sidebar')

    <main class="main-container">
        @yield('content')
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} Materiales y Servicios Industriales. Todos los derechos reservados.</p>
    </footer>

    <script src="{{ asset('js/main.js') }}"></script>
    @if(session('open_cart'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof openCartSidebar === 'function') {
                openCartSidebar();
            }
        });
    </script>
    @endif
</body>
</html>
