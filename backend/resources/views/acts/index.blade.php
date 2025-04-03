@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Acts of Kindness</h1>
    <a href="{{ route('acts.create') }}" class="btn btn-primary">Create Act</a>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Category</th>
                <th>User</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($acts as $act)
            <tr>
                <td>{{ $act->title }}</td>
                <td>{{ $act->category->name }}</td>
                <td>{{ $act->user->name }}</td>
                <td>
                    <a href="{{ route('acts.show', $act->id) }}" class="btn btn-info">View</a>
                    <a href="{{ route('acts.edit', $act->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('acts.destroy', $act->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
