<x-app-layout title="Users edit">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">
                {{ __('Users edit') }}
            </h5>

            <div class="mb-4">
                <a href="{{ route('users.index') }}" class="btn btn-dark">
                    {{ __('Back to list') }}
                </a>
            </div>

            <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
            
                @if($user->id)
                @method("PUT")
                @endif
              
    
            @if ($user->image)
                <center><img height="300px" id="previewImage" width="320px" class="text-center" image="image" src="{{ asset('storage/users/' . $user->image)}}">
                
                </center> 
                @else
                <center>
                <img height="300px" src="{{ asset('storage/users/user.default.jpg') }}" alt="Default Profile Image">
            </center>
                @endif
            
            
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
                 
                    @error('image')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror	
                </div>
                <div class="mb-3 col-md-6">
                    <x-label for="user_type" :value="__('USER')" />
                    <select name="user_type" class="form-control" id="user_type" tabindex="1">

                        <option value="user" {{  $user->user_type === '0' ? 'selected' : '' }}>user</option>
                        <option value="admin" {{ $user->user_type === '1' ? 'selected' : '' }}>admin</option>
                        
            
            
            
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

        </div>
    </div>
</x-app-layout>