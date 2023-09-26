<form action="{{ $user->id ? route('users.update', $user->id) : route('users.store') }}" method="POST" enctype="multipart/form-data">
	@csrf

	@if($user->id)
	@method("PUT")
	@endif

	<center>
		<img id="previewImage" src="#" alt="Preview Image" width="200px" style="display: none;">
	</center>



<div class="row">
	<div class="mb-3 col-md-6">
		<x-label for="name" :value="__('Name')" />
		<x-input type="text" name="name" id="name" :placeholder="__('Name')" :value="old('name', $user->name)" autofocus />
		<x-invalid error="name" />
	</div>

	<div class="mb-3 col-md-6">
		<x-label for="email" :value="__('Email')" />
		<x-input type="email" name="email" id="email" :placeholder="__('Email')" :value="old('email', $user->email)" />
		<x-invalid error="email" />
	</div>
</div>
<div class="row">
	<div class="mb-3 col-md-6">
		<x-label for="image" :value="__('Image')" />
		<input type="file" class="form-control" id="image" tabindex="1" name="image" id="image" />
		@if ($user->image)
			<img src="{{ asset('storage/' . $user->image) }}" alt="User Image" width="100" />
		@endif
		@error('image')
		<span class="text-danger">{{ $message }}</span>
		@enderror	
	</div>
	<div class="mb-3 col-md-6">
		<x-label for="user_type" :value="__('USER')" />
		<select name="user_type" class="form-control" id="user_type" tabindex="1">
			<option >اختر مستخدم</option>

			<option value="admin">admin</option>
			<option value="user" >user</option>



		</select>
		@error('user_type')
			<span class="text-danger">{{ $message }}</span>
			@enderror
	</div>
</div>
	
	<div class="row">

	@if($user->id)
	<div class="mb-3 col-md-6">
		<x-label for="password" :value="__('Password')" />
		<x-input type="password" name="password" id="password" :placeholder="__('Password')" />
		<x-invalid error="password">
			<small>{{ __('Empty if not change.') }}</small>
		</x-invalid>
	</div>

	<div class="mb-3 col-md-6">
		<x-label for="password_confirmation" :value="__('Password confirmation')" />
		<x-input type="password" name="password_confirmation" id="password_confirmation" :placeholder="__('Password confirmation')" />
		<x-invalid error="password_confirmation">
			<small>{{ __('Empty if not change.') }}</small>
		</x-invalid>
	</div>
	@else
	<div class="mb-3 col-md-6">
		<x-label for="password" :value="__('Password')" />
		<x-input type="password" name="password" id="password" :placeholder="__('Password')" />
		<x-invalid error="password" />
	</div>

	<div class="mb-3 col-md-6">
		<x-label for="password_confirmation" :value="__('Password confirmation')" />
		<x-input type="password" name="password_confirmation" id="password_confirmation" :placeholder="__('Password confirmation')" />
		<x-invalid error="password_confirmation" />
	</div>
	@endif
</div>
	<div class="text-end">
		<x-button type="submit" class="btn btn-primary" :value="$user->id ? __('Update') : __('Create')" />
	</div>


</form>
<script>
	// Get references to the input and image elements
const fileInput = document.getElementById('image');
const previewImage = document.getElementById('previewImage');

fileInput.addEventListener('change', function () {
    if (fileInput.files && fileInput.files[0]) {
        const reader = new FileReader();

        reader.onload = function (e) {
            previewImage.src = e.target.result;
            previewImage.style.display = 'block';
        };

        reader.readAsDataURL(fileInput.files[0]);
    }
});

</script>