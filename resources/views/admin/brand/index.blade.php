<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Brands
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">

            <div class="col-md-9">
                <div class="card">
                    @include('layouts.message')
                    <div class="card-header">All Brands
                    <b style="float: right;">Total: <span class="badge rounded-pill bg-danger">{{ count($brands) }}</span></b>
                    </div>

                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Logo</th>
                        <th scope="col">Brand Image</th>
                        <th scope="col">Brand Name</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($brands as $brand)
                        <tr>
                            <th scope="row">{{ $brands->firstItem()+$loop->index }}</th>
                            <td><a href="{{ url('brand/edit/'.$brand->id) }}"><img src="{{ asset($brand->brand_image) }}" alt="{{ $brand->brand_name. ' logo' }}" style="height:50px;"></a></td>
                            <td><span class="txt-sm">{{ $brand->brand_image }}</span></td>
                            <td>{{ $brand->brand_name }}</td>
                            <td>{{ carbon\carbon::parse($brand->created_at)->diffForHumans() }}</td>
                            <td>
                                <a href="{{ url('brand/edit/'.$brand->id) }}" class="btn btn-sm btn-info">Edit</a>
                                <a href="{{ url('brand/softdelete/'.$brand->id) }}" class="btn btn-sm btn-warning">Delete</a>
                            </td>

                        </tr>
                        @endforeach
                    </table>
                    {{ $brands->links() }}
                    </div>

                    <div class="card">
                    <div class="card-header">Trashed Brands </div>

                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Logo</th>
                        <th scope="col">Brand Image</th>
                        <th scope="col">Brand Name</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tbrands as $tbrand)
                        <tr>
                            <th scope="row">{{ $tbrands->firstItem()+$loop->index }}</th>
                            <td><img src="{{ asset($tbrand->brand_image) }}" alt="{{ $tbrand->brand_name. ' logo' }}" style="height:50px;"></td>
                            <td><span class="txt-sm">{{ $tbrand->brand_image }}</span></td>
                            <td>{{ $tbrand->brand_name }}</td>
                            <td>{{ carbon\carbon::parse($tbrand->created_at)->diffForHumans() }}</td>
                            <td>
                                <a href="{{ url('brand/restore/'.$tbrand->id) }}" class="btn btn-sm btn-success">Restore</a>
                                <a href="{{ url('brand/pdelete/'.$tbrand->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('This will be permanently deleted. Are you sure you want to proceed?')">Force Delete</a>
                            </td>

                        </tr>
                        @endforeach
                    </table>
                    {{ $tbrands->links() }}
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">Add Brand</div>
                        <div class="card-body">
                            <form action="{{ route('store.brand') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="brand_name" class="form-label">Brand Name</label>
                                    <input type="text" name="brand_name" class="form-control" id="brand_name">
                                    @error('brand_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="brand_image" class="form-label">Brand Image</label>
                                    <input type="file" name="brand_image" class="form-control" id="brand_image">
                                    @error('brand_image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <button type="submit" class="btn btn-primary">Add Brand</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
