@if (!$model->isAdmin())
    <x-utils.edit-button :href="route('covernote.document.edit', $model)" />
    <x-utils.link :href="route('covernote.document.followup.edit', $model)" class="btn btn-success btn-sm" :text="__('Follow Up')" />
@endif
