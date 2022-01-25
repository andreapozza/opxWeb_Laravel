<a title="Modifica" class="action text-orange-500 inertia" data-method="get" href="{{ route('cms.posts.edit', ['post' => $row->id]) }}">
  <i class="fas fa-pencil-alt"></i>
</a>

<a title="Cancella" class="action text-red-700 inertia" data-method="delete" href="{{ route('cms.posts.destroy', ['post' => $row->id]) }}">
  <i class="fas fa-trash"></i>
</a>