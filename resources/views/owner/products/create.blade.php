<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      店舗情報編集
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          <div class="flex flex-col text-center w-full mb-12">
            <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">店舗情報編集</h1>
          </div>
          <div class="lg:w-1/2 md:w-2/3 mx-auto">
            <x-input-error :messages="$errors->get('image')" class="mt-2" />
            <form method="POST" action="{{ route('owner.products.store') }}">
              @csrf
              <div class="p-2 w-full">
                <div class="relative">
                  <select name="category">
                    @foreach ($categories as $category)
                      <optgroup label="{{ $category->name }}">
                        @foreach ($category->secondary as $secondary)
                          <option value="{{ $secondary->id }}">
                            {{ $secondary->name }}
                          </option>
                        @endforeach
                    @endforeach
                  </select>
                  <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
              </div>
              <div class="p-2 w-full mt-4 flex justify-around">
                <button type="button" onclick="location.href='{{ route('owner.products.index') }}'"
                  class="text-white bg-gray-300 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">戻る</button>
                <button type="submit"
                  class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">登録</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</x-app-layout>
