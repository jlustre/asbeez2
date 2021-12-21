@extends('admin.admin_master')
@section('admin')

    <div class="py-12">
        <div class="container">
            <div class="row">

               <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Edit Slider</div>
                        <div class="card-body">
                            <form action="{{ url('slider/update/'.$slider->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" id="old_image" name="old_image" value="{{ $slider->image }}">
                                <input type="hidden" name="id" value="{{ $slider->id }}">
                                <div class="mb-3">
                                    <label for="id" class="form-label">Slider ID</label>: {{ $slider->id }}
                                </div>
                                <div class="mb-3">
                                    <label for="title" class="form-label">Slider Title</label>
                                    <input type="text" name="title" class="form-control" id="title"  value="{{ $slider->title }}">
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Slider Description</label>
                                    <textarea name="description" id="description" cols="70" rows="4">{{ $slider->description }}</textarea>
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="links" class="form-label">Slider Link</label>
                                    <input type="text" name="links" class="form-control" id="links"  value="{{ $slider->links }}">
                                    @error('links')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="image" class="form-label">Slider Image</label>
                                    <input type="file" name="image" class="form-control" id="image" value="{{ $slider->image }}">
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <button type="submit" class="btn btn-primary">Update Slider</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-12"><img src="{{ asset($slider->image) }}" alt="" style="width: 100%;">
                </div>
            </div>
        </div>
    </div>
@endsection
