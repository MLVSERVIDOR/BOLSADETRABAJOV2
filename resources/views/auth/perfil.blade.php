@canany(['ver-persona', 'ver-empresa'])
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mi Perfil | Municipalidad de La Victoria</title>

  <!-- Bootstrap & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

  <style>
    :root {
      --azul: #001f60;
      --gris-fondo: #f4f6f9;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background-color: var(--gris-fondo);
      color: #333;
    }

    header {
      background: var(--azul);
      color: white;
      padding: 15px 40px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    header .title {
      display: flex;
      align-items: center;
      font-weight: 600;
      font-size: 1.1rem;
    }

    header img {
      height: 42px;
      margin-right: 10px;
    }

    .logout {
      border: 2px solid #fff;
      padding: 6px 15px;
      border-radius: 10px;
      color: #fff;
      text-decoration: none;
      font-weight: 600;
      transition: 0.3s;
    }

    .logout:hover {
      background: #fff;
      color: var(--azul);
    }

    .btn-atras {
      background: #fff;
      color: var(--azul);
      font-weight: 600;
      border: none;
      border-radius: 50px;
      display: flex;
      align-items: center;
      gap: 6px;
      padding: 6px 14px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
      transition: 0.3s;
    }

    .btn-atras:hover {
      background: #e8eefc;
    }

    .main-container {
      padding: 25px;
    }

    .card-perfil {
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      padding: 1.5rem 2rem;
      border: 1px solid #eaeaea;
      max-width: 900px;
      margin: 40px auto;
    }

    .title-section h3 {
      font-weight: 700;
      font-size: 1.5rem;
      color: #001f60;
    }

    .form-label {
      font-weight: 600;
    }

    .btn-primary {
      background-color: #0B47DF;
      border: none;
      font-weight: 600;
      border-radius: 8px;
    }

    .btn-primary:hover {
      background-color: #0A3FD0;
    }
  </style>

  <style>
    .logo-preview {
      border: 2px dashed #dee2e6;
      border-radius: 8px;
      padding: 10px;
      background-color: #fafafa;
    }
    
    .logo-preview img {
      object-fit: contain;
    }
    
    .card-header {
      background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    }
  </style>
</head>

<body>
<body>
  <!-- 🔹 HEADER -->
  <header>
    <div class="d-flex align-items-center gap-3">
      <a href="{{ route('empresa.index') }}" class="btn-atras">
        <i class="bi bi-arrow-left-circle-fill"></i> Atrás
      </a>
      <div class="title">
        <img src="{{ asset('images/imagenes/logo_muni_v2.png') }}" alt="Logo">
        Municipalidad de La Victoria
      </div>
    </div>

    <div class="d-flex align-items-center gap-3">
      <a href="{{ route('logout') }}" class="logout">
        <i class="bi bi-door-open"></i> Cerrar Sesión
      </a>
    </div>
  </header>

  <!-- 🔹 CONTENIDO -->
  <div class="main-container">
    <div class="card-perfil">
      <div class="header-section mb-3">
        <div class="title-section">
          <h3>Datos de {{ $tipo === 'persona' ? 'la Persona' : 'la Empresa' }}</h3>
          <p>Actualiza la información registrada en tu cuenta</p>
        </div>
      </div>

      <hr>

      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      <form action="{{ route('perfil.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        @if($tipo === 'persona')
          <!-- ... formulario persona ... -->
        @elseif($tipo === 'empresa')



        

          <div class="row mb-4">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header bg-light">
                  <h5 class="mb-0">Logo de la Empresa</h5>
                </div>
                <div class="card-body">
                  <div class="row align-items-center">
                    <!-- Visualizador del Logo -->
                    <div class="col-md-4 text-center">
                      <div class="logo-preview mb-3">
    @if($user->url_logo)

        
        <img id="logoPreview" src="{{ asset('storage/' . $user->url_logo) }}" 
             alt="Logo de la empresa" class="img-thumbnail" 
             style="max-width: 200px; max-height: 150px; object-fit: contain;">
    @else
        <div id="logoPreview" class="border rounded d-flex align-items-center justify-content-center" 
             style="width: 200px; height: 150px; background-color: #f8f9fa;">
            <span class="text-muted">Sin logo</span>
        </div>
    @endif
</div>
                      
                    </div>
                    
                    <!-- Controles del Logo -->
                    <div class="col-md-8">
                      <div class="mb-3">
                        <label class="form-label">Cambiar Logo</label>
                        <input type="file" name="url_logo" id="logoInput" class="form-control" accept="image/*">
                        @error('url_logo')
                          <div class="text-danger small">{{ $message }}</div>
                        @enderror
                      </div>
                      
                      <div class="d-flex gap-2">
                        <small class="text-muted">Formato: JPG, PNG, SVG. Máx: 2MB</small>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>





          <!-- Información de la Empresa -->
          <div class="row mb-3">
            <div class="col-md-6">
              <label class="form-label">Razón Social</label>
              <input type="text" name="razon_social" value="{{ $user->razon_social }}" class="form-control">
            </div>
            <div class="col-md-6">
              <label class="form-label">RUC</label>
              <input type="text" class="form-control" value="{{ $user->nro_ruc }}" readonly>
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label">Dirección Empresa</label>
            <input type="text" name="direccion_empresa" value="{{ $user->direccion_empresa }}" class="form-control">
          </div>

          <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea name="descripcion" class="form-control" rows="3">{{ $user->descripcion }}</textarea>
          </div>
        @endif

        <div class="text-center mt-4">
          <button type="submit" class="btn btn-primary px-5 py-2">
            <i class="bi bi-save"></i> Guardar Cambios
          </button>
        </div>
      </form>
    </div>
  </div>
</body>

<!-- JavaScript para preview en tiempo real -->
<script>
    // Espera a que el DOM esté completamente cargado
    document.addEventListener('DOMContentLoaded', function () {
        const logoInput = document.getElementById('logoInput'); // Tu input de archivo
        const logoPreviewContainer = document.querySelector('.logo-preview'); // El div contenedor

        if (logoInput && logoPreviewContainer) {
            logoInput.addEventListener('change', function(event) {
                const file = event.target.files[0]; // Obtiene el archivo seleccionado

                // Verifica si se seleccionó un archivo y si es una imagen
                if (file && file.type.startsWith('image/')) {
                    const reader = new FileReader();

                    // Cuando el archivo se haya leído
                    reader.onload = function(e) {
                        // Busca si ya existe una imagen o el placeholder div
                        let previewElement = document.getElementById('logoPreview');

                        if (previewElement) {
                            // Si ya existe una imagen, actualiza su 'src'
                            if (previewElement.tagName === 'IMG') {
                                previewElement.src = e.target.result;
                            } 
                            // Si existe el div placeholder, reemplázalo con una nueva imagen
                            else if (previewElement.tagName === 'DIV') {
                                const newImg = document.createElement('img');
                                newImg.id = 'logoPreview'; // Mantén el mismo ID
                                newImg.src = e.target.result;
                                newImg.alt = 'Vista previa del logo';
                                newImg.className = 'img-thumbnail'; // Aplica clases de estilo
                                newImg.style.maxWidth = '200px';
                                newImg.style.maxHeight = '150px';
                                newImg.style.objectFit = 'contain'; // Asegura que la imagen encaje bien
                                
                                previewElement.replaceWith(newImg); // Reemplaza el div con la imagen
                            }
                        } else {
                             // Si por alguna razón no existe ni img ni div, crea la imagen dentro del contenedor
                             const newImg = document.createElement('img');
                             newImg.id = 'logoPreview';
                             newImg.src = e.target.result;
                             newImg.alt = 'Vista previa del logo';
                             newImg.className = 'img-thumbnail';
                             newImg.style.maxWidth = '200px';
                             newImg.style.maxHeight = '150px';
                             newImg.style.objectFit = 'contain';
                             logoPreviewContainer.innerHTML = ''; // Limpia el contenedor por si acaso
                             logoPreviewContainer.appendChild(newImg);
                        }
                    }

                    // Lee el archivo como una URL de datos (Data URL)
                    reader.readAsDataURL(file); 
                } else {
                    // Opcional: ¿Qué hacer si no se selecciona una imagen?
                    // Podrías mostrar el placeholder de nuevo o un mensaje.
                    console.log("Archivo no seleccionado o no es una imagen.");
                    // Por ejemplo, para volver al placeholder si existía la imagen:
                    // let previewElement = document.getElementById('logoPreview');
                    // if (previewElement && previewElement.tagName === 'IMG') {
                    //      const placeholderDiv = `<div id="logoPreview" class="border rounded d-flex align-items-center justify-content-center" 
                    //                             style="width: 200px; height: 150px; background-color: #f8f9fa;">
                    //                             <span class="text-muted">Sin logo</span></div>`;
                    //      logoPreviewContainer.innerHTML = placeholderDiv;
                    // }
                }
            });
        }
    });
</script>

</html>
@endcanany
