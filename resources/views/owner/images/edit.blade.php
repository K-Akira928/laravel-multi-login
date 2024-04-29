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
            <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">画像情報編集</h1>
          </div>
          <div class="lg:w-1/2 md:w-2/3 mx-auto">
            <x-input-error :messages="$errors->get('image')" class="mt-2" />
            <form method="POST" action="{{ route('owner.images.update', ['image' => $image->id]) }}"
              enctype="multipart/form-data">
              @csrf
              @method('put')
              <div class="p-2 w-full">
                <div class="relative">
                  <label for="title" class="leading-7 text-sm text-gray-600">タイトル</label>
                  <input type="text" id="title" name="title" value="{{ $image->title }}"
                    class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                </div>
              </div>
              <x-thumbnail :filename="$image->filename" type="products" />
              <div class="p-2 w-full mt-4 flex justify-around">
                <button type="button" onclick="location.href='{{ route('owner.images.index') }}'"
                  class="text-white bg-gray-300 border-0 py-2 px-8 focus:outline-none hover:bg-gray-400 rounded text-lg">戻る</button>
                <button type="submit"
                  class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">更新</button>
              </div>
            </form>
            <form id="delete_{{ $image->id }}" method="POST"
              action="{{ route('owner.images.destroy', ['image' => $image->id]) }}">
              @csrf
              @method('delete')
              <div class="w-full">
                <a href="#" data-id="delete_{{ $image->id }}" onclick=deletePost(this)
                  class="mt-4 block text-center text-white bg-red-400 border-0 py-2 focus:outline-none hover:bg-red-500 rounded text-lg">削除</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <script>
      function deletePost(e) {
        'use strict';
        if (confirm('本当に削除してもよろしいですか？')) {
          document.getElementById(e.dataset.id).submit();
        }
      }
    </script>
</x-app-layout>
