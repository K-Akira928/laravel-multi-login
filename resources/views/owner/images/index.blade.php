<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      画像管理
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
          <div class="py-2">
            <x-flash-message status="session('status')" />
          </div>
          <div class="flex justify-end mb-4">
            <button onclick="location.href='{{ route('owner.images.create') }}'"
              class="text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-sm">画像新規登録</button>
          </div>
          <div class="grid grid-cols-4 gap-6">
            @foreach ($images as $image)
              <div>
                <a href="{{ route('owner.images.edit', ['image' => $image->id]) }}">
                  <div class="border rounded-md p-4">
                    <x-thumbnail :filename="$image->filename" type="products" />
                    <div class="text-gray-700">
                      {{ $image->title }}
                    </div>
                  </div>
                </a>
              </div>
            @endforeach
          </div>
          <div class="py-4">
            {{ $images->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
