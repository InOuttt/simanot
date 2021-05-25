@if (!$model->isAdmin())
    <x-utils.edit-button :href="route('cluster.edit', $model)" />
    <x-utils.delete-button :href="route('cluster.destroy', $model)" />
@endif
