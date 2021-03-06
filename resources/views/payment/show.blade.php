<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between">
            <h2 class="font-semibold text-base text-gray-800 leading-tight">
                {{ __('Payment Management') }}
            </h2>

            <a href="{{ route('payments.create') }}" class="border-b-2 font-semibold text-base text-gray-800 leading-tight">{{ __('Create payment') }}
            </a>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="w-1/3 ml-4 pl-4 ">
            @livewire('import-payments')
        </div>

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
                                            CUSTOMER EMAIL
                                        </th>
                                        <th
                                            class="px-2 py-3 bg-gray-50 whitespace-no-wrap text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                            AMOUNT
                                        </th>
                                        <th
                                            class="px-2 py-3 bg-gray-50 whitespace-no-wrap text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                            DATE
                                        </th>
                                        <th
                                            class="px-2 py-3 bg-gray-50 whitespace-no-wrap text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                            created at
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

            var table = $('table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('payments.show') }}",
                pageLength: 20,
                columns: [
                    {
                        data: 'id',
                        name: 'id',
                        className: 'bg-gray-100'
                    },
                    {
                        data: 'customer_email',
                        name: 'customer_email',
                    },
                    {
                        data: 'amount',
                        name: 'amount'
                    },
                    {
                        data: 'date',
                        name: 'date'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'action',
                        name: 'action',
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
