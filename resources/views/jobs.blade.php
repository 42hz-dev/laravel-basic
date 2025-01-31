<x-layout>

    <x-slot:heading>
        Job Listings
    </x-slot:heading>

    <ul>
    @foreach($jobs as $job)
        <li class="text-blue-500 hover:underline">
            <a href="/jobs/{{ $job['id'] }}">
                <strong>{{ $job['title'] }}</strong>: Pays {{ $job['salary'] }} per years.
            </a>
        </li>
    @endforeach
    </ul>
</x-layout>
