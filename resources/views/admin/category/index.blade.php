<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Categories
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">

            <div class="col-md-8">
                <div class="card">
                   @include('layouts.message')
                    <div class="card-header">All Categories
                    <b style="float: right;">Total: <span class="badge rounded-pill bg-danger">{{ count($categories) }}</span></b>
                    </div>

                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Category Name</th>
                        <th scope="col">User</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                        <tr>
                            <th scope="row">{{ $categories->firstItem()+$loop->index }}</th>
                            <td>{{ $category->category_name }}</td>
                            <td>{{ $category->user->name }}</td>
                            <td>{{ carbon\carbon::parse($category->created_at)->diffForHumans() }}</td>
                            <td>
                                <a href="{{ url('category/edit/'.$category->id) }}" class="btn btn-sm btn-info">Edit</a>
                                <a href="{{ url('category/softdelete/'.$category->id) }}" class="btn btn-sm btn-warning">Delete</a>
                            </td>

                        </tr>
                        @endforeach
                    </table>
                    {{ $categories->links() }}
                    </div>

                    <div class="card">
                    <div class="card-header">Trashed Categories </div>

                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Category Name</th>
                        <th scope="col">User</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tcategories as $tcategory)
                        <tr>
                            <th scope="row">{{ $tcategories->firstItem()+$loop->index }}</th>
                            <td>{{ $tcategory->category_name }}</td>
                            <td>{{ $tcategory->user->name }}</td>
                            <td>{{ carbon\carbon::parse($tcategory->created_at)->diffForHumans() }}</td>
                            <td>
                                <a href="{{ url('category/restore/'.$tcategory->id) }}" class="btn btn-sm btn-success">Restore</a>
                                <a href="{{ url('category/pdelete/'.$tcategory->id) }}" class="btn btn-sm btn-danger">Force Delete</a>
                            </td>

                        </tr>
                        @endforeach
                    </table>
                    {{ $tcategories->links() }}
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Add Category</div>
                        <div class="card-body">
                            <form action="{{ route('store.category') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="category_name" class="form-label">Category Name</label>
                                    <input type="text" name="category_name" class="form-control" id="category_name">
                                    @error('category_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <button type="submit" class="btn btn-primary">Add Category</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
