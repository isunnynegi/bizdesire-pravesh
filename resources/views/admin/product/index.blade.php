<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex items-center justify-end mt-4">
                    <a href="{{ route('admin.product_create') }}">Create Product</a>
                </div>
                @if(session()->has('status'))
                  <div class="text-success font-weight-bold py-2">{{ session('status') }}</div>
                @endif
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th scope="col">No.</th>
                      <th scope="col">Name</th>
                      <th scope="col">Sku</th>
                      <th scope="col">Price</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($products as $key=>$product)
                    <tr>
                      <td>{{ $key+ $products->firstItem() }}</td>
                      <td>{{ $product->name }}</td>
                      <td>{{ $product->sku }}</td>
                      <td>{{ $product->price }}</td>
                      <td class="d-flex">
                        <div class="d-inline"><a type="button" href="{{ route('admin.product_edit', ['id'=>$product->id]) }}" class="btn btn-outline-primary btn-sm">Edit</a></div>
                        <div class="d-inline mx-2">
                        <form method="POST" action="{{ route('admin.product_delete', ['id'=>$product->id]) }}">
                          {{ csrf_field() }}
                          <div class="form-group">
                            <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                          </div>
                        </form>
                        </div>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <div class="pagination">
                    @if ($products->onFirstPage())
                        <span>&laquo;</span>
                    @else
                        <a href="{{ $products->previousPageUrl() }}" rel="prev">&laquo;</a>
                    @endif

                    @for ($i = 1; $i <= $products->lastPage(); $i++)
                        <a href="{{ $products->url($i) }}" @if ($i === $products->currentPage()) class="active" @endif>{{ $i }}</a>
                    @endfor

                    @if ($products->hasMorePages())
                        <a href="{{ $products->nextPageUrl() }}" rel="next">&raquo;</a>
                    @else
                        <span>&raquo;</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
