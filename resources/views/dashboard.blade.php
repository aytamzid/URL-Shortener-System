<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{--                    Table--}}
                        <div class="px-4 sm:px-6 lg:px-8">
                            <div class="sm:flex sm:items-center">
                                <div class="sm:flex-auto">
                                    <h1 class="text-base font-semibold leading-6 text-gray-900">Shortened URLs</h1>
                                    <p class="mt-2 text-sm text-gray-700">A list of all the urls shortened by you.</p>
                                </div>

                            </div>
                            <div class="mt-8 flow-root">
                                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    @isset($urls[0])
                                        <table class="min-w-full divide-y divide-gray-300">
                                            <thead>
                                            <tr>
                                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Short URL</th>
                                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Long URL</th>
                                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Total Click</th>
                                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-0">
                                                    <span class="sr-only">Edit</span>
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody class="divide-y divide-gray-200">
                                            @foreach($urls as $url)
                                                <tr>
                                                    <td class="pl-4 pr-3 py-3.5 whitespace-nowrap flex items-center">
                                                        <a href="{{$url->shorten_url}}" target="_blank" class="text-sm font-semibold text-gray-900">{{ Request::root() .'/'. $url->shorten_url   }}  </a>
                                                        <button class="ml-2 bg-gray-100 hover:bg-gray-200 text-gray-800 font-normal py-1 px-3 rounded-md shadow-sm border border-gray-300 text-sm"
                                                                onclick="navigator.clipboard.writeText('{{ Request::root() . '/' . $url->shorten_url }}')">
                                                            Copy
                                                        </button>


                                                    </td>
                                                    <td class="px-3 py-3.5 whitespace-nowrap">
                                                        <a href="{{$url->long_url}}" target="_blank" class="text-sm text-gray-900">{{ Str::limit($url->long_url, 30) }}</a>
                                                        <button class="ml-2 bg-gray-100 hover:bg-gray-200 text-gray-800 font-normal py-1 px-3 rounded-md shadow-sm border border-gray-300 text-sm"
                                                                onclick="navigator.clipboard.writeText('{{$url->long_url}}')">
                                                            Copy
                                                        </button>
                                                    </td>
                                                    <td class="px-3 py-3.5 whitespace-nowrap">
                                                        <div class="text-sm text-gray-900">{{ $url->total_clicked }}</div>
                                                    </td>
                                                    <td class="pl-3 pr-4 py-3.5 whitespace-nowrap text-right text-sm font-medium">
                                                        <form action="{{ route('urls.destroy', $url->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <x-danger-button>Delete</x-danger-button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach

                                            <!-- More people... -->
                                            </tbody>
                                        </table>
                    @else
                                        <div class="text-center text-gray-900">
                                            <p class="text-lg">No URLs shortened yet.</p>
                                            <a href="{{ route('urls.create') }}" class="text-blue-500 hover:underline">Generate New</a>
                                        </div>
                    @endisset
                                    </div>
                                </div>
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
