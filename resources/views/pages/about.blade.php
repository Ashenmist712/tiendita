@extends('layouts.app')

@section('content')


<div class="about-header">
    <h1 class="about-title">Materiales y Servicios Industriales</h1>
    <p class="about-subtitle">
        En Materiales y Servicios Industriales cumplimos orgullosamente más de 12 años de experiencia en la comercialización de productos y servicios para la industria. Suministramos equipos de seguridad industrial, herramientas mecánicas y eléctricas en general, materiales para la industria del petróleo, gas, agua y alimenticia.
    </p>
</div>

<div class="about-grid">
    <!-- Misión -->
    <div class="about-card" style="animation: fadeUp 1.2s ease-out;">
        <div class="card-icon">
            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="6"></circle><circle cx="12" cy="12" r="2"></circle></svg>
        </div>
        <h2 class="card-title">Nuestra Misión</h2>
        <div class="card-text">
            Trabajar de manera responsable y segura con nuestros clientes, ofreciendo soluciones, calidad y precio competitivo en todos nuestros productos y servicios. Nos enfocamos en entender y satisfacer las necesidades puntuales del sector industrial.
        </div>
    </div>

    <!-- Visión -->
    <div class="about-card" style="animation: fadeUp 1.4s ease-out;">
        <div class="card-icon">
            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path><circle cx="12" cy="12" r="3"></circle></svg>
        </div>
        <h2 class="card-title">Nuestra Visión</h2>
        <div class="card-text">
            Ser una empresa competitiva en precio, tiempo de entrega y servicio en todos nuestros productos, asegurando el crecimiento sostenido de nuestra empresa y manteniendo buenas relaciones con nuestros clientes y proveedores a través de la mejora continua.
        </div>
    </div>

    <!-- Política de Calidad / Objetivo -->
    <div class="about-card" style="animation: fadeUp 1.6s ease-out;">
        <div class="card-icon">
            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
        </div>
        <h2 class="card-title">Política de Calidad</h2>
        <div class="card-text">
            Es política de Materiales y Servicios Industriales, lograr la satisfacción de nuestros clientes en el suministro de productos de la más alta calidad:
            <ul>
                <li>Desarrollar, implementar y mantener un sistema de calidad.</li>
                <li>Poner a disposición recursos humanos y materiales adecuados.</li>
                <li>Capacitación constante de nuestro personal.</li>
            </ul>
        </div>
    </div>
</div>

@endsection
