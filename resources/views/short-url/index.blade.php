<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('List Short URLs') }}
        </h2>
        <div class="float-right btn btn-primary">
            <a href="{{ route('short-urls.create') }}" class="create" title="{{ __('Create') }}">
                {{ __('Create') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{ __('URL') }}</th>
                                <th scope="col">{{ __('Title') }}</th>
                                <th scope="col">{{ __('Hits') }}</th>
                                <th scope="col">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($shotUrls as $shotUrl)
                                <tr>
                                    <td scope="col">{{ $shotUrl->id }}</td>
                                    <td scope="col">{{ $shotUrl->url }}</td>
                                    <td scope="col">{{ $shotUrl->title }}</td>
                                    <td scope="col">{{ $shotUrl->hits }}</td>
                                    <td scope="col">
                                        <a href="{{ route('short-urls.edit', ['short_url' => $shotUrl->id]) }}" class="btn edit" title="{{ __('Edit') }}">
                                            {{ __('Edit') }}
                                        </a> |
                                        <a href="{{ route('short-urls.destroy', ['short_url' => $shotUrl->id]) }}" class="btn delete"
                                            onclick="event.preventDefault();
                                                document.getElementById('shotUrl-form-{!! $shotUrl->id !!}').submit();" title="{{ __('Delete') }}">
                                            {{ __('Delete') }}
                                        </a> |
                                        <a href="{{ route('s.show', ['code' => App\Models\ShortUrl::encode($shotUrl->id)]) }}" class="btn go" title="{{ __('Go') }}" target="_blank">
                                            {{ __('Go') }}
                                        </a>
                                        <form id="shotUrl-form-{{ $shotUrl->id }}" action="{{ route('short-urls.destroy', ['short_url' => $shotUrl->id]) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $shotUrls->links() }}
                </div>
            </div>
        </div>
    </div>

</x-guest-layout>
