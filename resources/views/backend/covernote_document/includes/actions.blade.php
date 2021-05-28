@if (!$model->isAdmin())
    <x-utils.edit-button :href="route('covernote.document.edit', $model)" />
    <x-utils.delete-button :href="route('covernote.document.destroy', $model)" />
@endif
