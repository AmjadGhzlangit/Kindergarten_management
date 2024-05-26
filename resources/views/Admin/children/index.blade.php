@extends('Admin.admin_dashboard')

@section('content')
<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Children Table</h4>
      <div class="table-responsive pt-3">
        <!-- Scrollable table container -->
        <div style="max-height: 400px; overflow-y: auto;">
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Age</th>
                <th>Education Stage</th>
                <th colspan="3" class="text-center">Options</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($children as $child)
                <tr>
                  <td>{{ $child->id }}</td>
                  <td>{{ $child->user->first_name }}</td>
                  <td>{{ $child->age }}</td>
                  <td>{{ $child->education_stage }}</td>
                  <td>
                    <a href="{{ route('children.show', [ $child->id]) }}" class="btn btn-success btn-rounded btn-fw btn-sm">Show</a>
                  </td>
                  <td>
                    <form action="{{ route('children.destroy', [ $child->id]) }}" method="POST" style="display: inline-block;">
                      @csrf
                      @method('delete')
                      <button type="submit" class="btn btn-danger btn-rounded btn-fw btn-sm" onclick="return confirm('Are you sure you want to delete this child?')">Delete</button>
                    </form>
                  </td>
                  <td>
                    <a href="{{ route('children.edit', $child->id) }}" class="btn btn-warning btn-rounded btn-fw btn-sm">Edit</a>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="7">No Children found</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
        <!-- End of scrollable table container -->
      </div>
    </div>
  </div>
</div>
{{ $children->links() }}
@endsection
