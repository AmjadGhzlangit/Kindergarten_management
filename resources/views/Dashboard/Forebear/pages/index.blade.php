@extends('Dashboard.Forebear.dashboard')

@section('forebear_content')
<div class="container">
    <h1>Children</h1>

    <div style="max-height: 400px; overflow-y: auto;">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Education Stage</th>
                    <th>Forebear</th>
                    <th>Level</th> <!-- New "Level" column -->
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($children as $child)
                    <tr>
                        <td>{{ $child->id }}</td>
                        <td>
                            {{ $child->user->first_name ?? 'Unknown' }} {{ $child->user->last_name ?? 'Unknown' }}
                        </td>
                        <td>{{ $child->age }}</td>
                        <td>{{ $child->education_stage }}</td>
                        <td>
                            @if($child->forebear && $child->forebear->user)
                                {{ $child->forebear->user->first_name ?? 'Unknown' }} {{ $child->forebear->user->last_name ?? 'Unknown' }}
                            @else
                                Unknown
                            @endif
                        </td>
                        <td>
                            {{ $child->reviews->first()?->level ?? 'Unknown' }}
                        </td>
                        <td>
                            <!-- Action buttons -->
                            <div class="btn-group" role="group" aria-label="Child Actions">
                                <a href="{{ route('forebear_child.show', ['forebear_child' => $child->id]) }}" class="btn btn-info" title="View">View</a>
                                <a href="{{ route('forebear_child.edit', ['forebear_child' => $child->id]) }}" class="btn btn-warning" title="Edit">Edit</a>
                                <form action="{{ route('forebear_child.destroy', ['forebear_child' => $child->id]) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this child?')">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
{{ $children->links() }}
@endsection
