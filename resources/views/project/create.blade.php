<x-app-layout title="Projects create">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">
                {{ __('Projects create') }}
            </h5>

            <div class="mb-4">
                <a href="{{ route('projects.index') }}" class="btn btn-dark">
                    {{ __('Back to list') }}
                </a>
            </div>

    
			@include('project._partials.form')

        </div>
    </div>
</x-app-layout>









