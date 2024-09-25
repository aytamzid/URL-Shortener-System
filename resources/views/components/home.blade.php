<x-app-layout>


    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl p-4 sm:rounded-lg">
                <form action="{{ route('urls.store') }}" method="POST">@csrf
                <h2 class="text-2xl mb-3">Paste the URL to be shortened.</h2>
                <x-input-label for="link" value="Long URL"/>
                <x-text-input id="link" class="block mt-1 w-full" type="text" name="url" :value="old('url')" required autofocus/>
                <x-input-error for="url" class="mt-2" :messages="$errors->get('url') ? ['Please enter a valid URL.'] : ''"/>
                <x-primary-button class="mt-4">Shorten URL</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
