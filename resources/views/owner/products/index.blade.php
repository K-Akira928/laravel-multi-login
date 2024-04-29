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
            <button onclick="location.href='{{ route('owner.products.create') }}'"
              class="text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-sm">新規登録</button>
          </div>
          <div class="grid grid-cols-4 gap-6">
            @foreach ($ownerInfo as $owner)
              @foreach ($owner->shop->product as $product)
                <div>
                  <a href="{{ route('owner.products.edit', ['product' => $product->id]) }}">
                    <div class="border rounded-md pt-4 px-4 text-center">
                      <x-thumbnail filename="{{ $product->imageFirst->filename ?? '' }}" type="products" />
                      <div class="text-gray-700">
                      </div>
                      <div class="py-4">
                        <span class="text-gray-700">{{ $product->name }}</span>
                      </div>
                    </div>
                  </a>
                </div>
              @endforeach
            @endforeach
          </div>
          <div class="py-4">
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
