<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Cart
        </h2>            
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        @if(isset($cartData['cartItems']) && !empty($cartData['cartItems']))
                        @foreach($cartData['cartItems'] as $index => $product)
                            <div class="flex items-center space-x-4 mb-4 text-gray-600 dark:text-gray-400">
                                <span>{{ $product['product']['name'] }}</span>
                                <span class="text-gray-500">${{ $product['product']['price'] }}</span>
                                <a href="{{route('cart.itemupdate',['action'=>'down','itemid'=>$product['id']])}}">-</a>
                                <input type="text" value="{{$product['qty']}}" class="w-12 text-center" readonly>
                                <a href="{{route('cart.itemupdate',['action'=>'up','itemid'=>$product['id']])}}">+</a>
                            </div>
                        @endforeach

                        <div class="mt-8">
                            <a class="bg-blue-500 text-white px-4 py-2" href="#">Checkout</a>
                        </div>
                        @else
                            <div class="mt-8">
                                <a class="bg-blue-500 text-white px-4 py-2" href="{{route('landing')}}">Continue Shopping</a>
                            </div>
                        @endif
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>