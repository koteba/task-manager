<x-app-layout title="project management">
	<div class="card">
		<div class="card-body">
			<h5 class="card-title">
				{{ __('project management') }}
			</h5>

			<div class="mb-4">
				<a href="{{ route('projects.create') }}" class="btn btn-primary">
					{{ __('Create new') }}
				</a>
			</div>

            <!-- table of projects -->
            <div class="table-responsive">
                <table class="table table-striped table-bordered mb-4">
                    <thead>
                        <tr>
                            <th>{{ __('#') }}</th>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Start Date') }}</th>
                            <th>{{ __('End Date') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Category') }}</th>
                            <th>{{ __('User') }}</th>
                            {{-- <th>{{ __('Is Verify') }}</th> --}}
                            <th>{{ __('#') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($projects as $project)
                        <tr>
                            <td>{{ $project->id }}</td>
                            <td>{{ $project->name }}</td>
                            <td>{{ $project->start_date }}</td>
                            <td>{{ $project->end_date }}</td>
                            <td>{{ $project->status_id }}</td>
                            <td>{{ $project->category->name }}</td>

                                
                            
                            <td>
                                @if ($project->projectassignment)
                                    @foreach ($project->projectassignment as $assignment)
                                        @php
                                            $user = $assignment->user;
                                        @endphp
                                        {{ $user->name }},
                                        {{-- يمكنك استخدام أي معلومات أخرى من المستخدم هنا --}}
                                    @endforeach
                                @endif

                            </td>

                            
                                {{-- <td>
                                    <span class="badge bg-{{ $project->status_id ? 'success' : 'danger' }}">
                                        {{ $project->email_verified_at ? __('Verify') : __('Not verify') }}
                                    </span>
                                </td> --}}
                                <td>
                                    {!! actionBtn(route('projects.edit', $project->id), 'info', 'edit') !!}
                                    {!! actionBtn(route('projects.destroy', $project->id), 'danger', 'trash', ["onclick='del(this)'"]) !!}
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
                
                    {!! $projects->links() !!}
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