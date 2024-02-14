<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Products') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex items-center justify-end mt-4">
                    <a href="{{ route('admin.product_index') }}">Back</a>
                </div>
                  <form method="POST" action="{{route('admin.product_store')}}">
                    @csrf
                    <div class="form-group">
                      <label for="formGroupName">Name</label>
                      <input type="text" class="form-control name" name="name" id="formGroupName"  placeholder="Name">
                      @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                      @endif
                    </div>
                    <div class="form-group mt-2">
                      <label for="formGroupSku">Sku</label>
                      <input type="text" class="form-control" name="sku" id="formGroupSku" placeholder="SKU">
                      @if ($errors->has('sku'))
                        <span class="text-danger">{{ $errors->first('sku') }}</span>
                      @endif
                    </div>
                    <div class="form-group mt-2">
                      <label for="formGroupPrice">Price</label>
                      <input type="number" step="0.01" min="0" class="form-control" name="price" id="formGroupPrice" placeholder="Price">
                      @if ($errors->has('price'))
                        <span class="text-danger">{{ $errors->first('price') }}</span>
                      @endif
                    </div>
                    <div class="form-group mt-2">
                      <label for="exampleFormDescription">Description</label>
                      <textarea class="form-control" id="exampleFormDescription" name="description" rows="5" placeholder="Description"></textarea>
                      @if ($errors->has('description'))
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                      @endif
                    </div>
                    <div class="form-group mt-2">
                      <label for="formGroupFullfillable">Is Fullfillable?</label>
                      <input type="checkbox" class="form-control" name="is_fullfillable" id="formGroupFullfillable" value="1">
                      @if ($errors->has('is_fullfillable'))
                        <span class="text-danger">{{ $errors->first('is_fullfillable') }}</span>
                      @endif
                    </div>
                    <div class="d-flex justify-content-between">
                      <div>
                        <button type="reset" class="btn btn-primary mt-4">Reset</button>
                      </div>
                      <div>
                        <button type="submit" class="btn btn-primary mt-4">Create</button>
                      </div>
                    </div>
                  </form>
                </div>
        </div>
    </div>
</x-admin-layout>