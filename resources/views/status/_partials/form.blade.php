<form action="{{ $status->id ? route('status.update', $status->id) : route('status.store') }}" method="POST">
	@csrf

	@if($status->id)
	@method("PUT")
	@endif

	<div class="mb-3">
		<x-label for="name" :value="__('Name')" />
		<x-input type="text" name="name" id="name" :placeholder="__('Name')" :value="old('name', $status->name)" autofocus />
		<x-invalid error="name" />
	</div>

    <div class="mb-3">
		<x-label for="notes" :value="__('Notes')" />
		<x-input type="text" name="notes" id="notes" :placeholder="__('Notes')" :value="old('notes', $status->notes)" autofocus />
		<x-invalid error="notes" />
	</div>





	<div class="text-end">
		<x-button type="submit" class="btn btn-primary" :value="$status->id ? __('Update') : __('Create')" />
	</div>


</form>