<button title="Cancella" class="action text-red-700 inertia" data-method="delete" href="{{ route('cms.posts.destroy', ['post' => $row->id]) }}">
  <i class="fas fa-trash"></i>
</button>