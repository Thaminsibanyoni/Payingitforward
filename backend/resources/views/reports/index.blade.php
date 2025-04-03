@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Reports</h1>
    <div class="card">
        <div class="card-header">
            Analytics Overview
        </div>
        <div class="card-body">
            <p><strong>Total Users:</strong> {{ $reports['total_users'] }}</p>
            <p><strong>Total Acts of Kindness:</strong> {{ $reports['total_acts'] }}</p>
            <p><strong>Total Donations:</strong> {{ $reports['total_donations'] }}</p>
            <p><strong>Most Active Categories:</strong>
                <ul>
                    @foreach ($reports['most_active_categories'] as $category)
                    <li>{{ $category['name'] }} ({{ $category['total'] }} acts)</li>
                    @endforeach
                </ul>
            </p>
        </div>
    </div>
</div>
@endsection
