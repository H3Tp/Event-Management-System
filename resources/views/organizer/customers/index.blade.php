@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2>Customer</h2>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">User Name</th>
                     
                    <th scope="col">Email</th>
                   
                    <th scope="col"> Phone</th>
                    <th scope="col">Create At</th>
                </tr>
                </thead>
                <tbody>
                @forelse($customers as $customer)
                    <tr>
                        <td>{{ $customer->name }}</td>
                        
                        <td>{{ $customer->email }}</td>
                        
                        <td>{{ $customer->phone }}</td>
                        <td>{{ $customer->created_at }}</td>
                    </tr>
                @empty
                    <p class="text-primary fw-bold">You don't have any customers.</p>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
