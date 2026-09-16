@forelse ($teachers as $teacher)
    <tr>
        <td>{{ $teacher->name }}</td>
        <td>{{ $teacher->email }}</td>
        <td>{{ $teacher->department }}</td>
        <td>
            @if ($teacher->image)
                <img src="{{ asset('storage/' . $teacher->image) }}" alt="Profile image for {{ $teacher->name }}" width="50" height="50">
            @else
                No Image
            @endif
        </td>
        <td><a href="{{ route('teacherlist.edit', $teacher) }}" class="btn btn-sm btn-primary">Update</a></td>
        <td>
            <form action="{{ route('teacherlist.destroy', $teacher) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
            </form>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="6" class="text-center text-muted">No teacher found.</td>
    </tr>
@endforelse
