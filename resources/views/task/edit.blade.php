<x-app-layout title="Task edit">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">
                {{ __('Task edit') }}
            </h5>

            <div class="mb-4">
                <a href="{{ route('tasks.index') }}" class="btn btn-dark">
                    {{ __('Back to list') }}
                </a>
            </div>

       <!-- this is for select2 -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />



<form action="{{ $task->id ? route('tasks.update', $task->id) : route('tasks.store') }}" method="POST">
	@csrf

	@if($task->id)
	@method("PUT")
	@endif
<div class="row">
	<div class="mb-3 col-md-6">
		<x-label for="name" :value="__('Name')" />
		<x-input type="text" name="name" id="name" :placeholder="__('Name')" :value="old('name', $task->name)" autofocus />
		<x-invalid error="name" />
	</div>
	<div class="mb-4 col-md-6">
		<x-label for="status_id" :value="__('STATUS')" />
		<select name="status_id" class="form-control" id="status_id" tabindex="1">
			<option value="">اختر حالة</option>
			<option value="IN_PROGRESS" {{ old('status_id', $task->status_id) == 'IN_PROGRESS' ? 'selected' : '' }}>تحت التنفيذ</option>
			<option value="COMPLETED" {{ old('status_id', $task->status_id) == 'COMPLETED' ? 'selected' : '' }}>مكتمل</option>
			<option value="PENDING" {{ old('status_id', $task->status_id) == 'PENDING' ? 'selected' : '' }}>قيد الانتظار</option>
			<option value="ACCEPTED" {{ old('status_id', $task->status_id) == 'ACCEPTED' ? 'selected' : '' }}>مقبول</option>
		</select>
		@error('status_id')
		<span class="text-danger">{{ $message }}</span>
		@enderror
	</div>

</div>
<div class="row">
	<div class="mb-3 col-md-6">
		<x-label for="start_date" :value="__('Start Date')" />
		<x-input type="date" name="start_date" id="start_date" :placeholder="__('Start Date')" :value="old('start_date', $task->start_date)" autofocus />
		<x-invalid error="start_date" />
	</div>

	<div class="mb-3 col-md-6">
		<x-label for="end_date" :value="__('End Date')" />
		<x-input type="date" name="end_date" id="end_date" :placeholder="__('End Date')" :value="old('end_date', $task->end_date)" autofocus />
		<x-invalid error="end_date" />
	</div>

</div>
	
	

	<div class="mb-3">
		<x-label for="user" :value="__('USER')" />
	
		<select class="form-select" data-placeholder="اختر موظف" name="user_ids[]" id="prepend-text-multiple-field" multiple>
			<option value="">اختر موظف</option>
			@php
			$userIdsInTotals = collect($alluserstasks)->pluck('user_id')->toArray();
			@endphp
	
			@foreach($allusersproject as $user)
				<option value="{{ $user->user_id }}" {{ in_array($user->user_id, $userIdsInTotals) ? 'selected' : '' }}>
					{{ $user->user->name }}
				</option>
			@endforeach
		</select>
		@error('user_ids')
		<span class="text-danger">{{ $message }}</span>
		@enderror
	</div>
	






	<div class="mb-3">
		<x-label for="description" :value="__('Description')" />
		<x-input type="text" name="description" id="description" :placeholder="__('Description')" :value="old('description', $task->description)" autofocus />
		<x-invalid error="description" />
	</div>

	<div class="mb-3">
		<x-label for="notes" :value="__('Notes')" />
		<x-input type="text" name="notes" id="notes" :placeholder="__('Notes')" :value="old('notes', $task->notes)" autofocus />
		<x-invalid error="notes" />
	</div>

	



	<div class="text-end">
		<x-button type="submit" class="btn btn-primary" :value="$task->id ? __('Update') : __('Create')" />
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

        </div>
    </div>
</x-app-layout>