@extends('adminlte::master')

@inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')

@section('adminlte_css')
    @stack('css')
    <link href="{{ asset('vendor/adminlte/dist/css/custom.css') }}" rel="stylesheet">
    @yield('css')
@stop

@section('classes_body', $layoutHelper->makeBodyClasses())

@section('body_data', $layoutHelper->makeBodyData())

@section('body')
    <div class="wrapper">

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
