<div class="w-80 overflow-hidden rounded-lg border border-slate-200 bg-white shadow-sm mb-10">
    <div class="flex items-center gap-4 p-4"> <!-- Added padding for better spacing -->
        <div class="flex w-1/4 items-center justify-center">
            <div class="relative h-16 w-16 animate-pulse rounded-full bg-blue-300 flex items-center justify-center">
                <i class="bi bi-person-lines-fill text-white text-2xl"></i> <!-- Adjust size as needed -->
            </div>
        </div>

        <div class="flex w-3/4 flex-col justify-center"> <!-- Adjusted width for better alignment -->
            <div class="mb-2 flex items-center">
                <span class="animate-pulse rounded-full"></span>
                <span class="h-2 w-32 animate-pulse rounded-full font-bold">USERMANAGEMENT</span>
            </div>
            <div class="mb-2 flex items-center">
                <span class="animate-pulse rounded-full"></span>
                <span class="h-2 w-32 text-blue-800 animate-pulse rounded-full my-2 font-bold">TOTAL: {{ \App\Models\User::count() }}</span>
            </div>

            <!-- Progress Bar -->
            <div class="relative w-full bg-blue-300 rounded-full h-2 mt-2">
                @php
                    $totalUsers = 100; // Example total
                    $currentUsers = \App\Models\User::count();
                    $percentage = ($currentUsers / $totalUsers) * 100;
                @endphp
                <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $percentage }}%;"></div>
            </div>
            <div class="text-xs text-gray-500 mt-1 text-right">{{ number_format($percentage, 2) }}% of users</div> <!-- Right aligned percentage -->
        </div>
    </div>
</div>
