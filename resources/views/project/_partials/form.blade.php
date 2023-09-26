<!-- this is for select2 -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />



<form action="{{ $project->id ? route('projects.update', $project->id) : route('projects.store') }}" method="POST">
	@csrf

	@if($project->id)
	@method("PUT")
	@endif

	<div class="row">
		<div class="mb-3 col-md-6">
			<x-label for="name" :value="__('Name')" />
			<x-input type="text" name="name" id="name" :placeholder="__('Name')" :value="old('name', $project->name)" autofocus />
			<x-invalid error="name" />
		</div>
	
		<div class="mb-3 col-md-6">
			<x-label for="start_date" :value="__('Start Date')" />
			<x-input type="date" name="start_date" id="start_date" :placeholder="__('Start Date')" :value="old('start_date', $project->start_date)" autofocus />
			<x-invalid error="start_date" />
		</div>
	</div>
	

	<div class="mb-3">
		<x-label for="end_date" :value="__('End Date')" />
		<x-input type="date" name="end_date" id="end_date" :placeholder="__('End Date')" :value="old('end_date', $project->end_date)" autofocus />
		<x-invalid error="end_date" />
	</div>



	<div class="mb-3">
		<x-label for="category_id" :value="__('Category')" />
	
		<select name="category_id" class="form-control" id="category_id" tabindex="1">
			<option value="">{{ __('Select a category') }}</option>
	
			@if (isset($categories) && !empty($categories) && count($categories) > 0)
				@foreach ($categories as $category)
					<option value="{{ $category->id }}">{{ $category->name }}</option>
				@endforeach
			@else
				<option disabled>{{ __('No categories available') }}</option>
			@endif
		</select>
		@error('category_id')
		<span class="text-danger">{{ $message }}</span>
		@enderror
	</div>
	
	<div class="mb-4">
		<x-label for="status_id" :value="__('STATUS')" />
			<select name="status_id" class="form-control" id="status_id" tabindex="1">
				<option value="">اختر حالة</option>


				<option value="IN_PROGRESS">IN PROGRESS</option>
				<option value="APPROVED">APPROVED</option>
				<option value="REJECTED">REJECTED</option>
				<option value="COMPLETED">COMPLETED</option>
			</select>
			@error('status_id')
			<span class="text-danger">{{ $message }}</span>
			@enderror
	</div>

	
	

	<div class="mb-3">
		<x-label for="user" :value="__('USER')" />

		{{-- <div class="input-group-text">USER</div> --}}
		<select class="form-select" data-placeholder="اختر المستخدم" name="user_ids[]" id="prepend-text-multiple-field" multiple>
			<option value="">اختر المستخدم</option>
			@foreach ($users as $user)
				<option value="{{ $user->id }}">{{ $user->name }}</option>
			@endforeach
		</select>
		@error('user_ids')
		<span class="text-danger">{{ $message }}</span>
		@enderror
	</div>






	<div class="mb-3">
		<x-label for="description" :value="__('Description')" />
		<x-input type="text" name="description" id="description" :placeholder="__('Description')" :value="old('description', $project->description)" autofocus />
		<x-invalid error="description" />
	</div>

	<div class="mb-3">
		<x-label for="notes" :value="__('Notes')" />
		<x-input type="text" name="notes" id="notes" :placeholder="__('Notes')" :value="old('notes', $project->notes)" autofocus />
		<x-invalid error="notes" />
	</div>

	



	<div class="text-end">
		<x-button type="submit" class="btn btn-primary" :value="$project->id ? __('Update') : __('Create')" />
	</div>


</form>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>

<script>
$( '#prepend-text-multiple-field' ).select2( {
    theme: "bootstrap-5",
    width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
    placeholder: $( this ).data( 'placeholder' ),
    closeOnSelect: false,
} );

</script>
