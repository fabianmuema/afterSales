<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
        <script
            src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
            crossorigin="anonymous"></script>
        <script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/fixedheader/3.2.2/js/dataTables.fixedHeader.min.js"></script>

        <style>
            /* Overrides to match the Tailwind CSS */
            /* width */
            ::-webkit-scrollbar {
                width: 14px;
            }

            /* Track */
            ::-webkit-scrollbar-track {
                border-radius: 90vh;
                background: lightgray;
            }

            /* Handle */
            ::-webkit-scrollbar-thumb {
                border: 5px solid transparent;
                border-radius: 100px;
                background-color: #3F83F8;
                background-clip: content-box;
                transition: all 2s;
            }

            /* Handle on hover */
            ::-webkit-scrollbar-thumb:hover {
                border: 6px solid transparent;
                border-radius: 100px;
                background-color: #3F83F8;
                background-clip: content-box;
                background: #2372ef;
            }

            .dataTables_wrapper {
                padding-top: 0.25rem;
                padding-bottom: 0.25rem
            }

            table.dataTable.no-footer {
                border-bottom-width: 1px;
                border-color: #d2d6dc
            }

            table.dataTable tbody td, table.dataTable tbody th {
                padding: 0.75rem 1rem;
                border-bottom-width: 1px;
                border-color: #d2d6dc
            }

            div.dt-buttons {
                padding: 1rem 1rem 1rem 0;
                display: flex;
                align-items: center
            }

            .dataTables_filter, .dataTables_info {
                padding: 1rem
            }

            .dataTables_wrapper .dataTables_paginate {
                padding: 1rem
            }

            .dataTables_filter label input {
                padding: 0.5rem;
                border-width: 2px;
                border-radius: 0.5rem
            }

            .dataTables_filter label input:focus {
                box-shadow: 0 0 0 3px rgba(118, 169, 250, 0.45);
                outline: 0
            }

            table.dataTable thead tr {
                border-radius: 0.5rem
            }

            table.dataTable thead tr th:not(.text-center) {
                text-align: left
            }

            table.dataTable thead tr th {
                background-color: #edf2f7;
                border-bottom-width: 2px;
                border-top-width: 1px;
                border-color: #d2d6dc
            }

            .dataTables_wrapper .dataTables_paginate .paginate_button.current:not(.disabled), .dataTables_wrapper .dataTables_paginate .paginate_button.next:not(.disabled), .dataTables_wrapper .dataTables_paginate .paginate_button.previous:not(.disabled), .dataTables_wrapper .dataTables_paginate .paginate_button:not(.disabled), button.dt-button {
                transition-duration: 150ms;
                transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
                transition-property: background-color, border-color, color, fill, stroke, opacity, box-shadow, transform;
                letter-spacing: 0.1em;
                text-transform: uppercase;
                color: #374151 !important;
                box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
                font-size: 0.75rem;
                font-weight: 600;
                align-items: center;
                display: inline-flex;
                border-width: 1px !important;
                border-color: #d2d6dc !important;
                border-radius: 0.375rem;
                background: #ffffff;
                overflow: visible;
                margin-bottom: 0
            }

            .dataTables_wrapper .dataTables_paginate .paginate_button.next:focus:not(.disabled), .dataTables_wrapper .dataTables_paginate .paginate_button.next:hover:not(.disabled), .dataTables_wrapper .dataTables_paginate .paginate_button.previous:focus:not(.disabled), .dataTables_wrapper .dataTables_paginate .paginate_button.previous:hover:not(.disabled), .dataTables_wrapper .dataTables_paginate .paginate_button:focus:not(.disabled), .dataTables_wrapper .dataTables_paginate .paginate_button:hover:not(.disabled), button.dt-button:focus, button.dt-button:focus:not(.disabled), button.dt-button:hover, button.dt-button:hover:not(.disabled) {
                background-color: #edf2f7 !important;
                border-width: 1px !important;
                border-color: #d2d6dc !important;
                color: #374151 !important
            }

            .dataTables_wrapper .dataTables_paginate .paginate_button.current:not(.disabled) {
                background: #6875f5 !important;
                color: #ffffff !important;
                border-color: #8da2fb !important
            }

            .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
                background-color: #8da2fb !important;
                color: #ffffff !important;
                border-color: #8da2fb !important
            }

            .dataTables_length select {
                padding: .25rem;
                border-radius: .25rem;
                background-color: #edf2f7;
            }

            .paging_simple_numbers {
                margin-right: 10px;
            }

            .dataTables_length {
                padding-top: 1.25rem;
            }

            [x-cloak] {
                display: none !important;
            }
        </style>


    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
