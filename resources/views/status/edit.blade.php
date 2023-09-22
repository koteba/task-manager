<x-app-layout title="status edit">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">
                {{ __('Statuss edit') }}
            </h5>

            <div class="mb-4">
                <a href="{{ route('status.index') }}" class="btn btn-dark">
                    {{ __('Back to list') }}
                </a>
            </div>

            @include('status._partials.form')

        </div>
    </div>
</x-app-layout>