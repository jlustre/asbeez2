<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Multiple Images
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <!-- <div class="card-group"> -->
                        @include('layouts.message')
                    <!-- </div> -->
                    <div class="card-group">
                        @foreach($images as $image)
                        <div class="col-md-3 mt-3">
                            <div class="card"><img src="{{ asset($image->image) }}" alt=""></div>
                        </div>
                        @endforeach
                    </div>

                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Add Image</div>
                        <div class="card-body">
                            <form action="{{ route('store.image') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <input type="file" name="images[]" class="form-control" id="images" multiple="">
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <button type="submit" class="btn btn-primary">Add Image</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
