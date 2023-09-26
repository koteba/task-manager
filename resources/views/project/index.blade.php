<x-app-layout title="Project Management">
	<div class="card">
		<div class="card-body">
			<h5 class="card-title">
				{{ __('PROJECT MANAGEMENT') }}
			</h5>

			<div class="mb-4">
				<a href="{{ route('projects.create') }}" class="btn btn-primary">
					{{ __('Create new') }}
				</a>
				<a href="{{ route('projects.archive') }}" class="btn btn-secondary">
					{{ __('Trash ') }}
				</a>
                <a href="{{ route('projects.index') }}" class="btn btn-info">
					{{ __('Refresh ') }}
				</a>
			</div>
            <div style="display:block;">
            <div class="row justify-content-end">
                <div class="col-md-6">
                    <form action="{{ route('projects.index') }}" method="GET">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="search_projects" value="" required class="form-control rounded"
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
            <!-- table of projects -->
            <div class="table-responsive">
                <table class="table table-striped table-bordered mb-4">
                    <thead>
                        <tr>
                            <th>{{ __('#') }}</th>
                            <th>{{ __('Name') }}</th>
                            {{-- <th>{{ __('Start Date') }}</th>  --}}
                            <th>{{ __('End Date') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Category') }}</th>
                            <th>{{ __('NUM TASK') }}</th>
                            <th>{{ __('ADD Task') }}</th>
                            {{-- <th>{{ __('Is Verify') }}</th> --}}
                            <th>{{ __('ACTION') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($projects as $project)
                        <tr>
                            <td>{{ $project->id }}</td>
                            <td>{{ $project->name }}</td>
                            {{-- <td>{{ $project->start_date }}</td> --}}
                            <td>{{ $project->end_date }}</td>
                            <td>{{ $project->status_id }}</td>
                            <td>{{ $project->category->name }}</td>
                            <td>{{ $project->tasks->count() }}</td>

                                
                            
                            {{-- <td>
                                @if ($project->projectassignment)
                                    @foreach ($project->projectassignment as $assignment)
                                        @php
                                            $user = $assignment->user;
                                        @endphp
                                        {{ $user->name }},
                                    @endforeach
                                @endif

                            </td> --}}

                            
                                {{-- <td>
                                    <span class="badge bg-{{ $project->status_id ? 'success' : 'danger' }}">
                                        {{ $project->email_verified_at ? __('Verify') : __('Not verify') }}
                                    </span>
                                </td> --}}
                                <td>
                                    {!! actionBtn(route('task.create', ['project' => $project->id]), 'success', 'plus') !!}
                                    {!! actionBtn(route('all.show', ['project' => $project->id]), 'info', 'show') !!}

                                </td>
                                <td>
                                    {!! actionBtn(route('projects.edit', $project->id), 'info', 'edit') !!}
                                    {!! actionBtn(route('projects.destroy', $project->id), 'warning', 'trash', ["onclick='del(this)'"]) !!}

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
                        swalConfirm('Are you sure ?', `سيتم حذف المشروع .`, 'Yes, delete it!', () => {
                            form.submit()
                        })
                    }
                </script>
                @endpush
    
    
            </div></div></x-app-layout> 