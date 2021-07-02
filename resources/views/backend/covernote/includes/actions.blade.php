@if (!$model->isAdmin())
    <!-- <x-utils.view-button :href="route('covernote.view', $model)" /> -->
    <x-utils.edit-button :href="route('covernote.edit', $model)" />
    <!-- <x-utils.delete-button :href="route('covernote.destroy', $model)" /> -->
@endif
