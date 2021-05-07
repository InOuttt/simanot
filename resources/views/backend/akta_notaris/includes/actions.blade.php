@if (!$model->isAdmin())
    <x-utils.view-button :href="route('akta.notaris.view', $model)" />
    <x-utils.edit-button :href="route('akta.notaris.edit', $model)" />
    <x-utils.delete-button :href="route('akta.notaris.destroy', $model)" />
@endif
