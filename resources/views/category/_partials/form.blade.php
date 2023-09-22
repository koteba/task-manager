<form action="{{ $category->id ? route('category.update', $category->id) : route('category.store') }}" method="POST">
	@csrf

	@if($category->id)
	@method("PUT")
	@endif

	<div class="mb-3">
		<x-label for="name" :value="__('Name')" />
		<x-input type="text" name="name" id="name" :placeholder="__('Name')" :value="old('name', $category->name)" autofocus />
		<x-invalid error="name" />
	</div>

    <div class="mb-3">
		<x-label for="notes" :value="__('Notes')" />
		<x-input type="text" name="notes" id="notes" :placeholder="__('Notes')" :value="old('notes', $category->notes)" autofocus />
		<x-invalid error="notes" />
	</div>

	{{-- <div class="mb-3">
		<x-label for="email" :value="__('Email')" />
		<x-input type="email" name="email" id="email" :placeholder="__('Email')" :value="old('email', $category->email)" />
		<x-invalid error="email" />
	</div> --}}

	

	<div class="text-end">
		<x-button type="submit" class="btn btn-primary" :value="$category->id ? __('Update') : __('Create')" />
	</div>


</form>