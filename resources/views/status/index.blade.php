<x-app-layout title="Status management">
	<div class="card">
		<div class="card-body">
			<h5 class="card-title">
				{{ __('Status management') }}
			</h5>

			<div class="mb-4">
				<a href="{{ route('status.create') }}" class="btn btn-primary">
					{{ __('Create new') }}
				</a>
			</div>

            <!-- table of statuses -->
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
                        @forelse($statuses as $status)
                        <tr>
                            <td>{{ $status->id }}</td>
                            <td>{{ $status->name }}</td>
                            <td>{{ $status->notes }}</td>
                            {{-- <td>
                                <span class="badge bg-{{ $status->email_verified_at ? 'success' : 'danger' }}">
                                    {{ $status->email_verified_at ? __('Verify') : __('Not verify') }}
                                </span>
                            </td> --}}
                            <td>
                                {!! actionBtn(route('status.edit', $status->id), 'info', 'edit') !!}
                                {{-- {!! actionBtn(route('status.delete', $status->id), 'danger', 'trash', ["onclick='del(this)'"]) !!} --}}
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
            
                {!! $statuses->links() !!}
            </div>


		</div>
	</div>
</x-app-layout>