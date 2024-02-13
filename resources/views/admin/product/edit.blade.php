@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                  {{ __('Edit Post') }}
                </div>

                <div class="card-body">
                  <form method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                      <label for="formGroupTitle">Title</label>
                      <input type="text" class="form-control" name="title" id="formGroupTitle" placeholder="Blog Title" value="{{ $blog->title }}">
                      @if ($errors->has('title'))
                        <span class="text-danger">{{ $errors->first('title') }}</span>
                      @endif
                    </div>
                    <div class="form-group mt-2">
                      <label for="formGroupAuthor">Author</label>
                      <input type="text" class="form-control" name="author" id="formGroupAuthor"  placeholder="Author Name" value="{{ $blog->author }}">
                      @if ($errors->has('author'))
                        <span class="text-danger">{{ $errors->first('author') }}</span>
                      @endif
                    </div>
                    <div class="form-group mt-2">
                      <label for="exampleFormContent">Content</label>
                      <textarea class="form-control" id="exampleFormContent" name="content" rows="5" placeholder="Blog Content">{{ $blog->content }}</textarea>
                      @if ($errors->has('content'))
                        <span class="text-danger">{{ $errors->first('content') }}</span>
                      @endif
                    </div>
                    <div class="d-flex justify-content-between">
                      <div>
                        <button type="submit" class="btn btn-primary mt-4">Update</button>
                      </div>
                      <div>
                        <a type="submit" class="btn btn-link mt-4" href="{{ url('/') }}">back to home</a>
                      </div>
                    </div>

                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
