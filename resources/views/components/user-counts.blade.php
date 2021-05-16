<div>
    <a href="{{ route('users.index') }}" class="text-blue-400 text-sm mr-2">All ({{ $counts['all'] ?? 0 }})</a>
    <a href="{{ route('users.admins.index') }}" class="text-blue-400 text-sm mr-2">Admins ({{ $counts['Admin'] ?? 0 }})</a>
    <a href="{{ route('users.editors.index') }}" class="text-blue-400 text-sm mr-2">Editors ({{ $counts['Editor'] ?? 0 }})</a>
    <a href="{{ route('users.authors.index') }}" class="text-blue-400 text-sm">Author ({{ $counts['Author'] ?? 0 }})</a>
</div>
