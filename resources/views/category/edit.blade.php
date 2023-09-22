<x-app-layout title="Category edit">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">
                {{ __('Category edit') }}
            </h5>

            <div class="mb-4">
                <a href="{{ route('category.index') }}" class="btn btn-dark">
                    {{ __('Back to list') }}
                </a>
            </div>

    
			@include('category._partials.form')

        </div>
    </div>
</x-app-layout>









