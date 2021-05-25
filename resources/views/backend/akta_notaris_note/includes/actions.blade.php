@if (!$model->isAdmin())
    <x-utils.add-button :href="route('akta.note.create', $model)" />
    <x-utils.edit-button :href="route('akta.note.edit', $model)" />
    <x-utils.delete-button :href="route('akta.note.destroy', $model)" />
@endif
