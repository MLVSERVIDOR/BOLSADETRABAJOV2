<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Portal de Empleos - Municipalidad de La Victoria</title>

  <!-- Bootstrap y fuentes -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

  <style>
    :root {
      --primary-color: rgb(0, 32, 96);
      --gray-bg: #f2f2f2;
      --card-bg: #ffffff;
    }

    body {
      background-color: var(--gray-bg);
      font-family: 'Poppins', sans-serif;
    }

    /* ===== ENCABEZADO ===== */
    header {
      background-color: #fff;
      padding: 10px 30px;
      border-bottom: 1px solid #ddd;
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
    }

    header img {
      height: 90px;
      margin: 0;
    }

    header .titulo {
      font-weight: 300;
      color: #000;
      font-size: 1.9rem;
      margin-left: 12px;
      line-height: 1;
    }

    .header-right {
      display: flex;
      align-items: center;
      gap: 15px;
    }

    header .login-link {
      color: var(--primary-color);
      font-weight: 500;
      text-decoration: none;
      font-size: 0.95rem;
      display: flex;
      align-items: center;
      gap: 5px;
      transition: 0.3s;
    }

    header .login-link:hover {
      color: #0b47df;
    }

    /* ===== BANNER ===== */
    .banner {
      background-color: var(--primary-color);
      color: #fff;
      text-align: center;
      padding: 30px 1px 30px;
    }

    .banner h2 {
      font-size: 2rem;
      font-weight: 500;
      margin-bottom: 10px;
    }

    .banner p {
      font-size: 1.05rem;
      margin-bottom: 10px;
      opacity: 0.9;
    }

    .search-bar {
      max-width: 750px;
      margin: 0 auto;
      display: flex;
      justify-content: center;
    }

    .search-bar input {
      border: none;
      border-radius: 5px 0 0 5px;
      padding: 1px 15px;
      width: 100%;
      font-size: 1rem;
    }

    .search-bar button {
      background-color: #3579dc;
      color: white;
      border: none;
      padding: 3px 25px;
      border-radius: 0 5px 5px 0;
      font-size: 1rem;
    }

    /* ===== CATEGORÍAS ===== */
    .categories {
      padding: 23px 0 40px;
    }

    .categories h3 {
      text-align: center;
      color: #555;
      font-weight: 600;
      font-size: 1.4rem;
      margin-bottom: 40px;
    }

    .category-card {
      background-color: var(--card-bg);
      border-radius: 10px;
      text-align: center;
      padding: 35px 20px;
      transition: transform 0.25s ease, box-shadow 0.25s ease;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .category-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    }

    .category-card i {
      font-size: 2.2rem;
      color: var(--primary-color);
      margin-bottom: 12px;
    }

    .category-card p {
      margin: 0;
      font-weight: 600;
      color: #333;
      font-size: 1rem;
    }

    .category-card small {
      display: block;
      color: #777;
      font-size: 0.9rem;
      margin-bottom: 10px;
    }

    .vacantes {
      background-color: #5a5a5a;
      color: white;
      border-radius: 20px;
      font-size: 0.85rem;
      padding: 5px 15px;
      display: inline-block;
    }

    /* ===== FOOTER ===== */
    footer {
      background-color: #ededed;
      padding: 60px 0 25px;
      margin-top: 40px;
    }

    footer h5 {
      text-align: center;
      font-weight: 600;
      color: #444;
      margin-bottom: 30px;
    }

    .footer-box {
      background-color: #dcdcdc;
      border-radius: 10px;
      padding: 25px;
      text-align: center;
      height: 100%;
    }

    .footer-box i {
      font-size: 1.6rem;
      color: var(--primary-color);
      margin-bottom: 10px;
    }

    .footer-box h6 {
      font-weight: bold;
      margin-bottom: 5px;
    }

    .footer-box p {
      color: #555;
      font-size: 0.95rem;
      margin-bottom: 0;
    }

    .copy {
      text-align: center;
      color: #666;
      margin-top: 30px;
      font-size: 0.9rem;
    }

    .copy a {
      color: var(--primary-color);
      text-decoration: none;
    }
  </style>

</head>
<body>
  <!-- HEADER -->
  <header>
    <div class="d-flex align-items-center">
      <img src="https://web.munilavictoria.gob.pe/mlv/assets/imgs/logo.png" alt="Logo La Victoria">
      <span class="titulo">Portal de Empleos</span>
    </div>

    <div class="header-right">
      <a href="{{ route('login') }}" class="login-link">
        <i class="bi bi-door-open"></i> Iniciar Sesión
      </a>
      @can('ver-persona')
        <a href="{{ route('logout') }}" class="login-link">
          <i class="bi bi-box-arrow-right"></i> Cerrar Sesión
        </a>
      @endcan
    </div>
  </header>

  <!-- BANNER -->
  <section class="banner">
    <h2>Encuentra el trabajo que estás buscando</h2>
    <p>Miles de oportunidades laborales te esperan en la Municipalidad de La Victoria</p>

    <!-- 🔹 Buscador funcional -->
    <form method="GET" action="{{ route('welcome') }}" class="search-bar">
      <input type="text" name="buscar" placeholder="Buscar categorías..." value="{{ request('buscar') }}">
      <button type="submit"><i class="bi bi-search"></i> Buscar</button>
    </form>
  </section>

  <!-- CATEGORÍAS -->
  <section class="categories container">
    <h3>Categorías destacadas</h3>

    <div class="row g-4 justify-content-center">
        @forelse($categorias as $categoria)
            <div class="col-6 col-md-3">
                <a href="{{ route('persona.show', $categoria->id) }}" class="text-decoration-none text-dark">
                    <div class="category-card">
                        <i class="{{ $categoria->icono }}"></i>
                        <p>{{ $categoria->nombre }}</p>
                        <small>{{ $categoria->sub_nombre ?? 'Sin descripción' }}</small>
                        
                        {{-- 🔹 Mostrar el conteo de ofertas --}}
                        @php
                            $cantidadOfertas = $conteoOfertas[$categoria->id_categoria_ocupacionals] ?? 0;
                        @endphp
                        <span class="vacantes">{{ $cantidadOfertas }} oferta{{ $cantidadOfertas != 1 ? 's' : '' }}</span>
                    </div>
                </a>
            </div>
        @empty
            <div class="text-center text-muted mt-3">
                <p>No hay categorías registradas por el momento.</p>
            </div>
        @endforelse
    </div>
  </section>

  <!-- FOOTER -->
  <footer>
    <div class="container">
      <h5>Contacto</h5>
      <div class="row g-3">
        <div class="col-md-4">
          <div class="footer-box">
            <i class="bi bi-geo-alt"></i>
            <h6>Ubicación</h6>
            <p>Av. Iquitos N° 500, Lima 13 - Perú</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="footer-box">
            <i class="bi bi-telephone"></i>
            <h6>Teléfono</h6>
            <p>Palacio Municipal (01)5102070</p>
            <h6>Anexo</h6>
            <p>Gerencia de Desarrollo Económico "7100"</p>
          </div>
        </div>
        <div class="col-md-4">
          <div class="footer-box">
            <i class="bi bi-envelope"></i>
            <h6>Email</h6>
            <p>
              consultaseinformes@munilavictoria.gob.pe<br />
              buzondesugerencias@munilavictoria.gob.pe<br />
              denunciasyquejas@munilavictoria.gob.pe
            </p>
          </div>
        </div>
      </div>

      <p class="copy">
        ©2025 - Municipalidad de la Victoria - <a href="#">Todos los derechos reservados.</a>
      </p>
    </div>
  </footer>
</body>
</html>
