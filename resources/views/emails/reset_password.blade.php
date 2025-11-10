<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Restablecer contraseña | Municipalidad de La Victoria</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Poppins', Arial, sans-serif;
      background-color: #f4f6f9;
      color: #333;
    }

    .container {
      max-width: 600px;
      margin: 40px auto;
      background: #ffffff;
      border-radius: 12px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
      overflow: hidden;
    }

    .header {
      background: #001f60;
      color: white;
      text-align: center;
      padding: 25px 15px;
    }

    .header img {
      width: 90px;
      margin-bottom: 10px;
    }

    .header h1 {
      margin: 0;
      font-size: 1.3rem;
      font-weight: 600;
      letter-spacing: 0.5px;
    }

    .content {
      padding: 35px 40px;
      text-align: center;
    }

    .content h2 {
      color: #001f60;
      font-size: 1.3rem;
      margin-bottom: 15px;
      font-weight: 700;
    }

    .content p {
      color: #555;
      font-size: 0.95rem;
      line-height: 1.6;
      margin-bottom: 25px;
    }

    .btn {
      display: inline-block;
      background: #0B47DF;
      color: white !important;
      text-decoration: none;
      padding: 12px 30px;
      border-radius: 30px;
      font-weight: 600;
      letter-spacing: 0.3px;
      transition: background 0.3s ease;
    }

    .btn:hover {
      background: #0a3dc9;
    }

    .footer {
      background: #f4f6f9;
      text-align: center;
      padding: 15px;
      font-size: 0.85rem;
      color: #666;
      border-top: 1px solid #e6e6e6;
    }

    .footer a {
      color: #0B47DF;
      text-decoration: none;
    }
  </style>
</head>
<body>

  <div class="container">
    <!-- Header -->
    <div class="header">
      <img src="{{ asset('images/imagenes/logo_muni_v2.png') }}" alt="Municipalidad de La Victoria">
      <h1>Municipalidad de La Victoria</h1>
    </div>

    <!-- Content -->
    <div class="content">
      <h2>Hola {{ $user->nombres ?? 'usuario' }},</h2>
      <p>
        Hemos recibido una solicitud para restablecer tu contraseña.  
        Si tú no realizaste esta solicitud, puedes ignorar este mensaje.
      </p>

      <p>
        Haz clic en el botón de abajo para restablecer tu contraseña:
      </p>

      <a href="{{ $resetLink }}" class="btn" target="_blank">
        Restablecer contraseña
      </a>
    </div>

    <!-- Footer -->
    <div class="footer">
      © {{ date('Y') }} Municipalidad de La Victoria — Todos los derechos reservados.  
      <br>
      <a href="https://web.munilavictoria.gob.pe/mlv/" target="_blank">www.munilavictoria.gob.pe</a>
    </div>
  </div>

</body>
</html>
