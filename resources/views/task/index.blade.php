<x-app-layout title="Task Management">
	<div class="card">
		<div class="card-body">
			<h5 class="card-title">
				{{ __('TASK MANAGEMENT') }}
			</h5>

            <div class="mb-4">
				
                <a href="{{ route('tasks.index') }}" class="btn btn-info">
					{{ __('Refresh ') }}
				</a>
			</div>

			<div class="mb-3">
				{{-- <a href="{{ route('tasks.create') }}" class="btn btn-primary">
					{{ __('Create new') }}
				</a> --}}
                <div style="display:block;">
                    <div class="row justify-content-end">
                        <div class="col-md-6">
                            <form action="{{ route('tasks.index') }}" method="GET">
                                @csrf
                                <div class="input-group">
                                    <input type="text" name="search_tasks" value="" required class="form-control rounded"
                                        placeholder=" Search by name" />
                                    <button type="submit" class="btn btn-primary rtl">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row justify-content-end" style="margin-top:14px;">
                        <div class="col-md-4">
                            <form action="#" method="GET">
                                @csrf
                                <div class="input-group">
                                    <input type="date" name="to_date"  required  class="form-control rounded" placeholder="بحث حسب تاريخ الادخال  " />
                                    <button type="submit" class="btn btn-primary">To</button>
                                </div>
                        </div>
                        <div class="col-md-4" >
                            <div class="input-group">
                                <input type="date" name="from_date"  required class="form-control rounded"  placeholder="بحث حسب تاريخ الادخال  " />
                                <button type="" class="btn btn-primary">From</button>
                            </div>
                          
                            </form>
                        </div>
                    </div>
                </div>
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

                            
                        
                                <td>
                                    {{-- {!! actionBtn(route('tasks.edit', $task->id), 'info', 'edit') !!} --}}
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
                        swalConfirm('Are you sure ?', `The task will be deleted  ..`, 'Yes, delete it!', () => {
                            form.submit()
                        })
                    }
                </script>
                @endpush
    
    
            </div></div></x-app-layout> 