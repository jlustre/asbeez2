@extends('admin.admin_master')
@section('admin')

    <div class="py-12">
        <div class="container">
            <div class="row">

            <div class="col-md-9">
                <div class="card">
                    @include('layouts.message')
                    <div class="card-header">All Sliders
                    <b style="float: right;">Total: <span class="badge rounded-pill bg-danger">{{ count($sliders) }}</span></b>
                    </div>

                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Slider Image</th>
                        <th scope="col">Title/Description/Link</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sliders as $slider)
                        <tr>
                            <th scope="row">{{ $sliders->firstItem()+$loop->index }}</th>
                            <td><a href="{{ url('slider/edit/'.$slider->id) }}"><img src="{{ asset($slider->image) }}" alt="" style="height:50px;"></a></td>
                            <td><strong>{{ $slider->title }}</strong><br><span class="txt-sm">{{ $slider->description }}</span><br>{{ $slider->links }}</td>
                            <td>{{ carbon\carbon::parse($slider->created_at)->diffForHumans() }}</td>
                            <td>
                                <a href="{{ url('slider/edit/'.$slider->id) }}" class="btn btn-sm btn-info">Edit</a>
                                <a href="{{ url('slider/softdelete/'.$slider->id) }}" class="btn btn-sm btn-warning">Delete</a>
                            </td>

                        </tr>
                        @endforeach
                    </table>
                    {{ $sliders->links() }}
                    </div>

                    <div class="card">
                    <div class="card-header">Trashed Sliders </div>

                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Slider Image</th>
                        <th scope="col">Title/Description/Link</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tsliders as $tslider)
                        <tr>
                            <th scope="row">{{ $tsliders->firstItem()+$loop->index }}</th>
                            <td><img src="{{ asset($tslider->image) }}" alt="" style="height:50px;"></td>
                            <td><span class="txt-sm"><strong>{{ $tslider->title }}</strong><br><span class="txt-sm">{{ $tslider->description }}</span><br>{{ $tslider->links }}</span></td>
                            <td>{{ carbon\carbon::parse($tslider->created_at)->diffForHumans() }}</td>
                            <td>
                                <a href="{{ url('slider/restore/'.$tslider->id) }}" class="btn btn-sm btn-success">Restore</a>
                                <a href="{{ url('slider/pdelete/'.$tslider->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('This will be permanently deleted. Are you sure you want to proceed?')">Force Delete</a>
                            </td>

                        </tr>
                        @endforeach
                    </table>
                    {{ $tsliders->links() }}
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">Add Slider</div>
                        <div class="card-body">
                            <form action="{{ route('store.slider') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="image" class="form-label">Slider Image</label>
                                    <input type="file" name="image" class="form-control" id="image">
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="title" class="form-label">Slider Title</label>
                                    <input type="text" name="title" class="form-control" id="title">
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Slider Description</label>
                                    <textarea name="description" id="description" cols="30" rows="4"></textarea>
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="links" class="form-label">Slider Link</label>
                                    <input type="text" name="links" class="form-control" id="links">
                                    @error('links')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <button type="submit" class="btn btn-primary">Add Slider</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
