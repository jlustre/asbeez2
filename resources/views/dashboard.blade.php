<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        Hi .. <b>{{ Auth::user()->name }}</b>
        <b style="float: right;">Total Users <span class="badge rounded-pill bg-danger">{{ count($users) }}</span></b>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Created At</th>
                    </tr>
                </thead>
                <tbody>
                    @php ($i =1)
                    @foreach ($users as $user)
                    <tr>
                        <th scope="row">{{ $i++ }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ carbon\carbon::parse($user->created_at)->diffForHumans() }}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
