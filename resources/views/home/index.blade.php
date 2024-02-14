<x-guest-layout>

    @foreach($products as $product)
        <div class="max-w-md mx-auto bg-white rounded-xl overflow-hidden md:max-w-2xl mt-4">
            <img class="object-cover w-full h-64" src="https://hinacreates.com/wp-content/uploads/2021/06/dummy2-450x341.png" alt="{{ $product->name }}">

            <div class="p-6">
                <h2 class="font-bold text-xl">{{ $product->name }}</h2>
                <p class="mt-4">{{ $product->description }}</p>
                <p class="mt-4 text-gray-700">Price: ${{ $product->price }}</p>

                <button class="mt-4 bg-blue-500 hover:bg-blue-700 text-grey font-bold py-2 px-4 rounded">
                    Add to Cart
                </button>
            </div>
        </div>
    @endforeach
</x-guest-layout>