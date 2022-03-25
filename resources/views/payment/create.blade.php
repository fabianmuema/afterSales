<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Payment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('payments.store') }}">
                        @csrf

                        <div class="mt-6">
                            <label for="email" class="block text-sm font-medium leading-5 text-gray-700">
                                {{ __('Customer email') }}
                            </label>
                            <div class="mt-1 rounded-md shadow-sm">
                                <select id="email" type="email"
                                        class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5"
                                        name="customer_email" required autocomplete="email" autofocus>
                                    <option value="">&mdash; select &mdash;</option>
                                    @foreach($customers as $cust)
                                        <option value="{{ $cust->email }}">{{ $cust->email }}</option>
                                    @endforeach
                                </select>
                            </div>

                            @error('email')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <div class="mt-6">
                            <label for="amount" class="block text-sm font-medium leading-5 text-gray-700">
                                Amount
                            </label>
                            <div class="mt-1 rounded-md shadow-sm">
                                <input id="amount" type="number" name="amount" required
                                       autocomplete="amount"
                                       class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('amount') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red @enderror"/>
                            </div>
                            @error('amount')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <div class="mt-6">
                            <label for="date" class="block text-sm font-medium leading-5 text-gray-700">
                                {{ __('Date') }}
                            </label>
                            <div class="mt-1 rounded-md shadow-sm">
                                <input id="date" type="date" name="date" required
                                       autocomplete="date"
                                       class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('date') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red @enderror"/>
                            </div>
                            @error('date')
                            <p class="mt-2 text-sm text-red-600">
                                {{ $message }}
                            </p>
                            @enderror
                        </div>
                        <div class="mt-6">
                            <span class="block w-full rounded-md shadow-sm">
                                <button type="submit"
                                        class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
                                    {{ __('Update') }}
                                </button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
