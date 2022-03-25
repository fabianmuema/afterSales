<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Customer') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('customers.update', ['customer' => $customer->id]) }}">
                        @csrf

                        <div class="mt-6">
                            <label for="name" class="block text-sm font-medium leading-5 text-gray-700">
                                {{ __('Name') }}
                            </label>
                            <div class="mt-1 rounded-md shadow-sm">
                                <input id="name" type="text" name="name" value="{{ $customer->name }}" required autocomplete="name" autofocus class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('name') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red @enderror" />
                            </div>
                            @error('name')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="mt-6">
                            <label for="email" class="block text-sm font-medium leading-5 text-gray-700">
                                {{ __('E-Mail Address') }}
                            </label>
                            <div class="mt-1 rounded-md shadow-sm">
                                <input id="email" type="email" name="email" value="{{ $customer->email }}" required autocomplete="email" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('email') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:shadow-outline-red @enderror" />
                            </div>
                            @error('email')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
{{--                        submit button--}}
                        <div class="mt-6">
                            <span class="block w-full rounded-md shadow-sm">
                                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-500 focus:outline-none focus:border-indigo-700 focus:shadow-outline-indigo active:bg-indigo-700 transition duration-150 ease-in-out">
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
