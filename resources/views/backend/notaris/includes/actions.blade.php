@if (!$model->isAdmin())
    <x-utils.edit-button :href="route('notaris.edit', $model)" />
    <x-utils.delete-button :href="route('notaris.destroy', $model)" />
@endif
