<x-app-layout title="Tasks create">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">
                {{ __('Tasks create') }}
            </h5>

            <div class="mb-4">
                <a href="{{ route('tasks.index') }}" class="btn btn-dark">
                    {{ __('Back to list') }}
                </a>
            </div>

    
			@include('task._partials.form')

        </div>
    </div>
</x-app-layout>









