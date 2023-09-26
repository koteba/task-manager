<x-app-layout title="Task management">
	<div class="card">
		<div class="card-body">
			<h5 class="card-title">
				{{ __('TASK MANAGEMENT FOR PROJECT') }}
			</h5>

		
            <div class="mb-4">
                <a href="{{ route('projects.index') }}" class="btn btn-dark">
                    {{ __('Back to list') }}
                </a>
            </div>
            <!-- table of tasks -->
            <div class="table-responsive">
                <table class="table table-striped table-bordered mb-4">
                    <thead>
                        <tr>
                            <th>{{ __('#') }}</th>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Project') }}</th>
                            <th>{{ __('Start Date') }}</th>
                            <th>{{ __('End Date') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('User') }}</th>
                            {{-- <th>{{ __('Is Verify') }}</th> --}}
                            <th>{{ __('#') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tasks as $task)
                        <tr>
                            <td>{{ $task->id }}</td>
                            <td>{{ $task->name }}</td>
                            <td>{{ $task->project->name}}</td>
                            <td>{{ $task->start_date }}</td>
                            <td>{{ $task->end_date }}</td>
                            <td>{{ $task->status_id }}</td>


                         
                                
                                
                            
                            <td>
                                @if ($task->taskassignment)
                                    @foreach ($task->taskassignment as $assignment)
                                        @php
                                            $user = $assignment->user;
                                        @endphp
                                        {{ $user->name }},
                                        {{-- يمكنك استخدام أي معلومات أخرى من المستخدم هنا --}}
                                    @endforeach
                                @endif

                            </td>

                            
                                {{-- <td>
                                    <span class="badge bg-{{ $task->status_id ? 'success' : 'danger' }}">
                                        {{ $task->email_verified_at ? __('Verify') : __('Not verify') }}
                                    </span>
                                </td> --}}
                                <td>
                                    {!! actionBtn(route('tasks.edit', $task->id), 'info', 'edit') !!}
                                    {!! actionBtn(route('tasks.destroy', $task->id), 'danger', 'trash', ["onclick='del(this)'"]) !!}
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
                
                    {!! $tasks->links() !!}
                </div>
                
                @push('js')
                <script>
                    function del(element) {
                        event.preventDefault()
                        let form = document.getElementById('delete-form');
                        form.setAttribute('action', element.getAttribute('href'))
                        swalConfirm('Are you sure ?', `سيتم حذف التاسك.`, 'Yes, delete it!', () => {
                            form.submit()
                        })
                    }
                </script>
                @endpush
    
    
            </div></div></x-app-layout> 