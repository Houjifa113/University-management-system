@forelse ($students as $student)
    <tr>
        <td>{{ $student->username }}</td>
        <td>{{ $student->email }}</td>
        <td>{{ $student->gender }}</td>
        <td>{{ $student->department }}</td>
        <td>
            @if ($student->image)
                <img src="{{ asset('storage/' . $student->image) }}" alt="Profile image for {{ $student->username }}" width="50" height="50">
            @else
                No Image
            @endif
        </td>
        <td><a href="{{ route('student.profile.edit', $student) }}" class="btn btn-sm btn-primary">Update</a></td>
        <td>
            <form action="{{ route('student.destroy', $student) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
            </form>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="7" class="text-center text-muted">No student found.</td>
    </tr>
@endforelse
