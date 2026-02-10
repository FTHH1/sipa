@foreach ($logs as $log)
    <tr>
        <td>{{ $log->user?->email ?? '-' }}</td>
        <td>{{ $log->action }}</td>
        <td>{{ $log->description }}</td>
        <td>{{ $log->created_at }}</td>
    </tr>
@endforeach
    