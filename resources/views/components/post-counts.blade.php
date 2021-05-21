<div>
    <a href="{{ route('posts.index') }}" class="text-blue-400 text-sm mr-2">All ({{ $counts['all'] ?? 0 }})</a>
    <a href="{{ route('posts.published.index') }}" class="text-blue-400 text-sm mr-2">Published ({{ $counts['published'] ?? 0 }})</a>
    <a href="{{ route('posts.drafts.index') }}" class="text-blue-400 text-sm mr-2">Drafts ({{ $counts['draft'] ?? 0 }})</a>
    <a href="{{ route('posts.trash.index') }}" class="text-red-500 text-sm">Trash ({{ $counts['trashed'] ?? 0 }})</a>
</div>
