@extends('admin.admin_master')
@section('admin')

    <div class="py-12">
        <div class="container">
            <div class="row">

               <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Edit Brand</div>
                        <div class="card-body">
                            <form action="{{ url('brand/update/'.$brand->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" id="old_image" name="old_image" value="{{ $brand->brand_image }}">
                                <input type="hidden" name="id" value="{{ $brand->id }}">
                                <div class="mb-3">
                                    <label for="id" class="form-label">Brand ID</label>: {{ $brand->id }}
                                </div>
                                <div class="mb-3">
                                    <label for="brand_name" class="form-label">Brand Name</label>
                                    <input type="text" name="brand_name" class="form-control" id="brand_name"  value="{{ $brand->brand_name }}">
                                    @error('brand_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="brand_image" class="form-label">Brand Image</label>
                                    <input type="file" name="brand_image" class="form-control" id="brand_image" value="{{ $brand->brand_image }}">
                                    @error('brand_image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <button type="submit" class="btn btn-primary">Update Brand</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4"><img src="{{ asset($brand->brand_image) }}" alt="{{ $brand->brand_name. ' logo' }}">
                </div>
            </div>
        </div>
    </div>
@endsection
