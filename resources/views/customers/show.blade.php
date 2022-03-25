<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between">
            <h2 class="font-semibold text-base text-gray-800 leading-tight">
                {{ __('Customer Management') }}
            </h2>

            <a href="{{ route('customers.create') }}" class="border-b-2 font-semibold text-base text-gray-800 leading-tight">{{ __('Create customer') }}
            </a>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="min-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <table class="divide-y divide-gray-200">
                                    <thead>
                                    <tr>
                                        <th class="px-2 py-3 bg-gray-50 whitespace-no-wrap text-left text-xs font-medium text-gray-500 uppercase">
                                            #
                                        </th>
                                        <th
                                            class="px-2 py-3 bg-gray-50 whitespace-no-wrap text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                            CUSTOMER NAME
                                        </th>
                                        <th
                                            class="px-2 py-3 bg-gray-50 whitespace-no-wrap text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                            EMAIL
                                        </th>
                                        <th
                                            class="px-2 py-3 bg-gray-50 whitespace-no-wrap text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                            LIFETIME REVENUE
                                        </th>
                                        <th
                                            class="px-2 py-3 bg-gray-50 whitespace-no-wrap text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                            TOTAL TRANSACTIONS
                                        </th>
                                        <th
                                            class="px-2 py-3 bg-gray-50 whitespace-no-wrap text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                            created at
                                        </th>
                                        <th
                                            class="px-2 py-3 bg-gray-50 whitespace-no-wrap text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                            Action
                                        </th>
                                        <th
                                            class="px-2 py-3 bg-gray-50 whitespace-no-wrap text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                            Action
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        td {
            font-size: 0.9em;
            white-space: nowrap;
        }

        .dt-buttons {
            padding: 1rem !important;
        }

        .dataTables_wrapper .dataTables_paginate {
            padding: 0rem !important;
        }

        .dataTables_filter label input {
            padding: 0.1rem !important;
        }
    </style>
    <script type="text/javascript">
        $(function () {
            $.fn.dataTable.render.ellipsis = function (cutoff, wordbreak, escapeHtml) {
                var esc = function (t) {
                    return t
                        .replace(/&/g, '&amp;')
                        .replace(/</g, '&lt;')
                        .replace(/>/g, '&gt;')
                        .replace(/"/g, '&quot;');
                };

                return function (d, type, row) {
                    // Order, search and type get the original data
                    if (type !== 'display') {
                        return d;
                    }

                    if (typeof d !== 'number' && typeof d !== 'string') {
                        return d;
                    }

                    d = d.toString(); // cast numbers

                    if (d.length < cutoff) {
                        return d;
                    }

                    var shortened = d.substr(0, cutoff - 1);

                    // Find the last white space character in the string
                    if (wordbreak) {
                        shortened = shortened.replace(/\s([^\s]*)$/, '');
                    }

                    // Protect against uncontrolled HTML input
                    if (escapeHtml) {
                        shortened = esc(shortened);
                    }

                    return '<span class="ellipsis" title="' + esc(d) + '">' + shortened +
                        '&#8230;</span>';
                };
            };

            $('table thead tr')
                .clone(true)
                .addClass('filters')
                .appendTo('table thead');


            var table = $('table').DataTable({
                orderCellsTop: true,
                fixedHeader: true,
                processing: true,
                serverSide: true,
                ajax: "{{ route('customers.show') }}",
                pageLength: 20,
                initComplete: function () {
                    var api = this.api();

                    // For each column
                    api
                        .columns()
                        .eq(0)
                        .each(function (colIdx) {
                            // Set the header cell to contain the input element
                            var cell = $('.filters th').eq(
                                $(api.column(colIdx).header()).index()
                            );
                            var title = $(cell).text();
                            $(cell).html('<input type="text" />');

                            // On every keypress in this input
                            $(
                                'input',
                                $('.filters th').eq($(api.column(colIdx).header()).index())
                            )
                                .off('keyup change')
                                .on('keyup change', function (e) {
                                    e.stopPropagation();

                                    // Get the search value
                                    $(this).attr('title', $(this).val());
                                    var regexr = '({search})'; //$(this).parents('th').find('select').val();

                                    var cursorPosition = this.selectionStart;
                                    // Search the column for that value
                                    api
                                        .column(colIdx)
                                        .search(
                                            this.value != ''
                                                ? regexr.replace('{search}', '(((' + this.value + ')))')
                                                : '',
                                            this.value != '',
                                            this.value == ''
                                        )
                                        .draw();

                                    $(this)
                                        .focus()[0]
                                        .setSelectionRange(cursorPosition, cursorPosition);
                                });
                        });
                },
                columns: [
                    {
                        data: 'id',
                        name: 'id',
                        className: 'bg-gray-100'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'lifetime_revenue',
                        name: 'lifetime_revenue'
                    },
                    {
                        data: 'total_transactions',
                        name: 'total_transactions'
                    },
                    {

                        data: 'created_at',
                        name: 'created_at'
                    },

                    {
                        data: 'edit',
                        name: 'edit',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'delete',
                        name: 'delete',
                        orderable: false,
                        searchable: false
                    },
                ],
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                columnDefs: [{
                    targets: 0,
                    render: $.fn.dataTable.render.ellipsis(50, '', 1)
                }],
                "oLanguage": {
                    "sProcessing": "<img style='width:50px; height:50px; position:absolute; top: 50%; left: 50%;' src='/images/loading.gif' />"
                },
                "deferRender": true,
                searchable: ['FIRSTNAME', 'LASTNAME', 'OTHERNAME']
            });
        });
    </script>


</x-app-layout>
