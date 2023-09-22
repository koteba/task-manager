<x-app-layout title="category management">
	<div class="card">
		<div class="card-body">
			<h5 class="card-title">
				{{ __('category management') }}
			</h5>

			<div class="mb-4">
				<a href="{{ route('category.create') }}" class="btn btn-primary">
					{{ __('Create new') }}
				</a>
			</div>

            <!-- table of categories -->
            <div class="table-responsive">
                <table class="table table-striped table-bordered mb-4">
                    <thead>
                        <tr>
                            <th>{{ __('#') }}</th>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Notes') }}</th>
                            {{-- <th>{{ __('Is Verify') }}</th> --}}
                            <th>{{ __('#') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->notes }}</td>
                            {{-- <td>
                                <span class="badge bg-{{ $category->email_verified_at ? 'success' : 'danger' }}">
                                    {{ $category->email_verified_at ? __('Verify') : __('Not verify') }}
                                </span>
                            </td> --}}
                            <td>
                                {!! actionBtn(route('category.edit', $category->id), 'info', 'edit') !!}
                                {!! actionBtn(route('category.destroy', $category->id), 'danger', 'trash', ["onclick='del(this)'"]) !!}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="100%" class="text-center">
                                {{ __('No data to display.') }}
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            
                <!-- Delete forms with javascript -->
                <form method="POST" class="d-none" id="delete-form">
                    @csrf
                    @method("DELETE")
                </form>
            
                {!! $categories->links() !!}
            </div>
            
            @push('js')
            <script>
                function del(element) {
                    event.preventDefault()
                    let form = document.getElementById('delete-form');
                    form.setAttribute('action', element.getAttribute('href'))
                    swalConfirm('Are you sure ?', `You won't be able to revert this.`, 'Yes, delete it!', () => {
                        form.submit()
                    })
                }
            </script>
            @endpush


        </div></div></x-app-layout>     