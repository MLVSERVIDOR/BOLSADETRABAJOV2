@extends('plantilla.layouts.panel') 

@section('panel_blanco')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row" style="margin-top: 10px">  
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Dashboard</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Statistics Cards -->
                <div class="row">
                    <!-- Total Postulantes -->
                    <div class="col-lg-2 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex flex-column">
                                        <div class="card-title">
                                            <h2 class="fw-bolder mb-25" id="totalPostulantes">0</h2>
                                            <span class="fw-medium">Total Postulantes</span>
                                        </div>
                                    </div>
                                    <div class="avatar bg-light-primary p-50">
                                        <div class="avatar-content">
                                            <i class="bi bi-people fs-4 text-primary"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Empresas -->
                    <div class="col-lg-2 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex flex-column">
                                        <div class="card-title">
                                            <h2 class="fw-bolder mb-25" id="totalEmpresas">0</h2>
                                            <span class="fw-medium">Total Empresas</span>
                                        </div>
                                    </div>
                                    <div class="avatar bg-light-success p-50">
                                        <div class="avatar-content">
                                            <i class="bi bi-building fs-4 text-success"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Puestos Pendientes -->
                    <div class="col-lg-2 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex flex-column">
                                        <div class="card-title">
                                            <h2 class="fw-bolder mb-25" id="puestosPendientes">0</h2>
                                            <span class="fw-medium">Puestos Pendientes</span>
                                        </div>
                                    </div>
                                    <div class="avatar bg-light-warning p-50">
                                        <div class="avatar-content">
                                            <i class="bi bi-clock-history fs-4 text-warning"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Porcentaje Aprobados -->
                    <div class="col-lg-2 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex flex-column">
                                        <div class="card-title">
                                            <h2 class="fw-bolder mb-25" id="porcentajeAprobados">0%</h2>
                                            <span class="fw-medium">Aprobados</span>
                                        </div>
                                    </div>
                                    <div class="avatar bg-light-info p-50">
                                        <div class="avatar-content">
                                            <i class="bi bi-check-circle fs-4 text-info"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Anuncios -->
                    <div class="col-lg-2 col-sm-6 col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex flex-column">
                                        <div class="card-title">
                                            <h2 class="fw-bolder mb-25" id="totalAnuncios">0</h2>
                                            <span class="fw-medium">Anuncios Publicados</span>
                                        </div>
                                    </div>
                                    <div class="avatar bg-light-danger p-50">
                                        <div class="avatar-content">
                                            <i class="bi bi-megaphone fs-4 text-danger"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts Section -->
                <div class="row match-height">
                    <!-- Postulaciones por Estado -->
                    <div class="col-lg-6 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Postulaciones por Estado</h4>
                            </div>
                            <div class="card-body">
                                <canvas id="postulacionesChart" height="300"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Anuncios por Categoría -->
                    <div class="col-lg-6 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Anuncios por Categoría</h4>
                            </div>
                            <div class="card-body">
                                <canvas id="categoriasChart" height="300"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Postulaciones Mensuales -->
                    <div class="col-lg-6 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Postulaciones Mensuales</h4>
                            </div>
                            <div class="card-body">
                                <canvas id="mensualChart" height="300"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Distribución por Modalidad -->
                    <div class="col-lg-6 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Distribución por Modalidad</h4>
                            </div>
                            <div class="card-body">
                                <canvas id="modalidadChart" height="300"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Datos del dashboard
        const dashboardData = {
            totalPostulantes: {{ $totalPostulantes ?? 0 }},
            totalEmpresas: {{ $totalEmpresas ?? 0 }},
            puestosPendientes: {{ $puestosPendientes ?? 0 }},
            porcentajeAprobados: {{ $porcentajeAprobados ?? 0 }},
            totalAnuncios: {{ $totalAnuncios ?? 0 }},
            postulacionesPorEstado: {
                labels: ['En Revisión', 'Aprobados', 'Rechazados'],
                data: [{{ $postulacionesEnRevision ?? 0 }}, {{ $postulacionesAprobadas ?? 0 }}, {{ $postulacionesRechazadas ?? 0 }}]
            },
            anunciosPorCategoria: {
                labels: {!! json_encode($categoriasNombres ?? []) !!},
                data: {!! json_encode($categoriasCount ?? []) !!}
            },
            postulacionesMensuales: {
                labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                data: {!! json_encode($mensualData ?? array_fill(0, 12, 0)) !!}
            },
            distribucionModalidad: {
                labels: {!! json_encode($modalidadesNombres ?? []) !!},
                data: {!! json_encode($modalidadesCount ?? []) !!}
            }
        };

        // Función para detectar modo oscuro
        function isDarkMode() {
            return document.body.classList.contains('dark-layout') || 
                   document.body.classList.contains('semi-dark-layout');
        }

        // Colores adaptables al modo oscuro
        function getChartColors() {
            const isDark = isDarkMode();
            
            return {
                textColor: isDark ? '#b4b7bd' : '#6e6b7b',
                gridColor: isDark ? '#3b4253' : '#ebe9f1',
                background: isDark ? '#283046' : '#ffffff',
                borderColor: isDark ? '#3b4253' : '#ebe9f1'
            };
        }

        // Actualizar estadísticas
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('totalPostulantes').textContent = dashboardData.totalPostulantes;
            document.getElementById('totalEmpresas').textContent = dashboardData.totalEmpresas;
            document.getElementById('puestosPendientes').textContent = dashboardData.puestosPendientes;
            document.getElementById('porcentajeAprobados').textContent = dashboardData.porcentajeAprobados + '%';
            document.getElementById('totalAnuncios').textContent = dashboardData.totalAnuncios;

            initializeCharts();
        });

        function initializeCharts() {
            const colors = getChartColors();

            // Configuración común para todos los gráficos
            const commonOptions = {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        labels: {
                            color: colors.textColor
                        }
                    }
                }
            };

            // Gráfico de Postulaciones por Estado
            new Chart(document.getElementById('postulacionesChart'), {
                type: 'doughnut',
                data: {
                    labels: dashboardData.postulacionesPorEstado.labels,
                    datasets: [{
                        data: dashboardData.postulacionesPorEstado.data,
                        backgroundColor: ['#FFC107', '#28A745', '#DC3545'],
                        borderWidth: 2,
                        borderColor: colors.background
                    }]
                },
                options: {
                    ...commonOptions,
                    plugins: {
                        ...commonOptions.plugins,
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return `${context.label}: ${context.raw}`;
                                }
                            }
                        }
                    }
                }
            });

            // Gráfico de Anuncios por Categoría
            new Chart(document.getElementById('categoriasChart'), {
                type: 'bar',
                data: {
                    labels: dashboardData.anunciosPorCategoria.labels,
                    datasets: [{
                        label: 'Anuncios',
                        data: dashboardData.anunciosPorCategoria.data,
                        backgroundColor: '#7367f0',
                        borderColor: '#7367f0',
                        borderWidth: 1
                    }]
                },
                options: {
                    ...commonOptions,
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: colors.gridColor
                            },
                            ticks: {
                                color: colors.textColor
                            }
                        },
                        x: {
                            grid: {
                                color: colors.gridColor
                            },
                            ticks: {
                                color: colors.textColor
                            }
                        }
                    }
                }
            });

            // Gráfico de Postulaciones Mensuales
            new Chart(document.getElementById('mensualChart'), {
                type: 'line',
                data: {
                    labels: dashboardData.postulacionesMensuales.labels,
                    datasets: [{
                        label: 'Postulaciones',
                        data: dashboardData.postulacionesMensuales.data,
                        borderColor: '#00cfe8',
                        backgroundColor: 'rgba(0, 207, 232, 0.1)',
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    ...commonOptions,
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: colors.gridColor
                            },
                            ticks: {
                                color: colors.textColor
                            }
                        },
                        x: {
                            grid: {
                                color: colors.gridColor
                            },
                            ticks: {
                                color: colors.textColor
                            }
                        }
                    }
                }
            });

            // Gráfico de Distribución por Modalidad
            new Chart(document.getElementById('modalidadChart'), {
                type: 'pie',
                data: {
                    labels: dashboardData.distribucionModalidad.labels,
                    datasets: [{
                        data: dashboardData.distribucionModalidad.data,
                        backgroundColor: ['#7367f0', '#28c76f', '#ea5455', '#ff9f43', '#00cfe8'],
                        borderWidth: 2,
                        borderColor: colors.background
                    }]
                },
                options: commonOptions
            });
        }

        // Observar cambios en el modo oscuro
        const observer = new MutationObserver(function(mutations) {
            mutations.forEach(function(mutation) {
                if (mutation.attributeName === 'class') {
                    // Re-inicializar gráficos cuando cambie el modo
                    setTimeout(initializeCharts, 100);
                }
            });
        });

        observer.observe(document.body, {
            attributes: true,
            attributeFilter: ['class']
        });
    </script>

    <style>
        .card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card:hover {
            transform: translateY(-2px);
        }

        .avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Asegurar que los textos sean legibles en modo oscuro */
        .card-title h2 {
            color: var(--bs-heading-color);
        }

        .card-title span {
            color: var(--bs-body-color);
        }
    </style>
@endsection