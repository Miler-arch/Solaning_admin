@extends('adminlte::master')

@inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')

@section('adminlte_css')
    @stack('css')

    @yield('css')
@stop

@section('classes_body', $layoutHelper->makeBodyClasses())

@section('body_data', $layoutHelper->makeBodyData())

@section('body')
    <div class="wrapper">
        <style>
            ::-webkit-scrollbar {
                width: 10px;
            }
            ::-webkit-scrollbar-track {
                background-color: #f1f1f1;
            }
            ::-webkit-scrollbar-thumb {
                background-color: #888;
                border-radius: 6px;
            }
            ::-webkit-scrollbar-corner {
                background-color: #f1f1f1;
            }
            * {
                scrollbar-width: thin;
                scrollbar-color: #888 #f1f1f1;
            }
            *::-webkit-scrollbar-track {
                background-color: #f1f1f1;
            }
            *::-webkit-scrollbar-thumb {
                background-color: #888;
                border-radius: 6px;
            }
            *::-webkit-scrollbar-corner {
                background-color: #f1f1f1;
            }

        </style>
        {{-- Preloader Animation --}}
        @if($layoutHelper->isPreloaderEnabled())
            @include('adminlte::partials.common.preloader')
        @endif

        {{-- Top Navbar --}}
        @if($layoutHelper->isLayoutTopnavEnabled())
            @include('adminlte::partials.navbar.navbar-layout-topnav')
        @else
            @include('adminlte::partials.navbar.navbar')
        @endif

        {{-- Left Main Sidebar --}}
        @if(!$layoutHelper->isLayoutTopnavEnabled())
            @include('adminlte::partials.sidebar.left-sidebar')
        @endif

        {{-- Content Wrapper --}}
        @empty($iFrameEnabled)
            @include('adminlte::partials.cwrapper.cwrapper-default')
        @else
            @include('adminlte::partials.cwrapper.cwrapper-iframe')
        @endempty

        {{-- Footer --}}
        @hasSection('footer')
            @include('adminlte::partials.footer.footer')
        @endif

        {{-- Right Control Sidebar --}}
        @if(config('adminlte.right_sidebar'))
            @include('adminlte::partials.sidebar.right-sidebar')
        @endif
        @include('sweetalert::alert')
    </div>
@stop

@section('adminlte_js')
    @stack('js')
        <script>
            $(document).ready(function() {
            $('#datatable').DataTable({
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
                },
                "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, 'Todos']],
                "pageLength": 50,
                "dom": 'Bfrtip',
                "buttons": [
                    {
                        extend: 'pageLength',
                        className: 'btn btn-dark',
                        text: 'Cantidad de filas'
                    },
                    // {
                    //     extend: 'excelHtml5',
                    //     className: 'btn btn-success',
                    // },
                    // {
                    //     extend: 'pdfHtml5',
                    //     className: 'btn btn-danger',
                    // },
                    // {
                    //     extend: 'print',
                    //     className: 'btn btn-info',
                    //     text: 'Imprimir'
                    // },
                    // {
                    //     extend: 'copy',
                    //     className: 'btn btn-warning',
                    // },
                    // {
                    //     extend: 'csv', // Agrega botón de copiar
                    //     className: 'btn btn-info',
                    // },
                    // {
                    //     extend: 'colvis',
                    //     className: 'btn btn-dark',
                    //     text: 'Columnas'
                    // },
                ],
                responsive: true
            });
        });

        </script>
    @yield('js')
@stop
