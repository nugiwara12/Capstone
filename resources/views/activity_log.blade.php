@extends('layouts.app3')

@section('contents')
<div class="page-heading w-full">
    <section class="section">
        <div class="bg-white shadow-md rounded-lg">
            <div class="p-4 border-b border-gray-200 flex justify-between">
                <h4 class="font-semibold text-lg">Log Datatable</h4>
                <!-- Show Entries Form -->
                <form method="GET" action="{{ route('activity/log') }}" class="flex items-center space-x-2">
                    <label for="entries" class="text-sm mt-2">Show</label>
                    <select name="entries" id="entries" class="border border-gray-300 rounded p-1 text-sm" onchange="this.form.submit()">
                        <option value="10" {{ request('entries') == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ request('entries') == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('entries') == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ request('entries') == 100 ? 'selected' : '' }}>100</option>
                    </select>
                    <span class="text-sm">entries</span>
                </form>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-400 border border-gray-300">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-black uppercase tracking-wider">#</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-black uppercase tracking-wider">Name</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-black uppercase tracking-wider">Email</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-black uppercase tracking-wider">Description</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-bold text-black uppercase tracking-wider">Date Time</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-400">
                        @if($activityLog->count() > 0)
                            @foreach($activityLog as $key => $item)
                            <tr class="{{ $loop->even ? 'bg-gray-50' : 'bg-white' }} hover:bg-gray-200">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-black">{{ ++$key }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-black">{{ $item->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-black">{{ $item->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-black">{{ $item->description }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-black">{{ $item->date_time }}</td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="py-2 px-4 text-center">No activity logs found</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <!-- Pagination Links -->
            <div class="p-4">
                {{ $activityLog->appends(['entries' => request('entries')])->links() }}
            </div>
        </div>
    </section>
</div>
@endsection
