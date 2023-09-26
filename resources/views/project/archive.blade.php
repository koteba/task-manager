<x-app-layout title="project Archive">
	<div class="card">
		<div class="card-body">
			<h5 class="card-title">
				{{ __('PROJECT TRASH') }}
			</h5>

            <div class="mb-4">
                <a href="{{ route('projects.index') }}" class="btn btn-dark">
                    {{ __('Back to list') }}
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
                        @forelse($archivedProjects as $project)
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
                                    {{-- <a href="{{ route('projects.restore', $project->id) }}" class="btn btn-sm  btn-primary"> <i
                                        class="fas fa-undo"></i> استعادة</a> --}}
                                        {!! actionBtn(route('projects.trash', $project->id), 'danger', 'trash', ["onclick='del(this)'"]) !!}
                                            {!! actionBtn(route('projects.restore', $project->id), 'primary','trash') !!}
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
                
                    {!! $archivedProjects->links() !!}
                </div>
                
                @push('js')
                <script>
                    function del(element) {
                        event.preventDefault()
                        let form = document.getElementById('delete-form');
                        form.setAttribute('action', element.getAttribute('href'))
                        swalConfirm('Are you sure ?', `سيتم حذف المشروع نهائيا.`, 'Yes, delete it!', () => {
                            form.submit()
                        })
                    }
                </script>
                @endpush
    
    
            </div></div></x-app-layout> 


















