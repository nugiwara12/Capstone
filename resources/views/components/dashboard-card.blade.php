<div class="flex flex-1 bg-gray-100 px-2 mb-4">
    <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 w-full">
        
        <!-- Gawang Gamat Email Record Card -->
        <div class="bg-white shadow-lg rounded-lg p-4">
            <div class="flex items-center">
                <div class="w-1/3 text-purple-500">
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-envelope-check" viewBox="0 0 16 16">
                        <path d="M2 2a2 2 0 0 0-2 2v8.01A2 2 0 0 0 2 14h5.5a.5.5 0 0 0 0-1H2a1 1 0 0 1-.966-.741l5.64-3.471L8 9.583l7-4.2V8.5a.5.5 0 0 0 1 0V4a2 2 0 0 0-2-2zm3.708 6.208L1 11.105V5.383zM1 4.217V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v.217l-7 4.2z"/>
                        <path d="M16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0m-1.993-1.679a.5.5 0 0 0-.686.172l-1.17 1.95-.547-.547a.5.5 0 0 0-.708.708l.774.773a.75.75 0 0 0 1.174-.144l1.335-2.226a.5.5 0 0 0-.172-.686"/>
                    </svg>
                </div>
                <div class="w-2/3">
                    <h6 class="text-gray-500 font-semibold">Gawang Gamat Email Record</h6>
                    <h6 class="font-extrabold mb-0">
                        <span class="bg-red-500 text-white text-sm rounded-full px-3 py-1">{{ \App\Models\Subscriber::count() }}</span>
                    </h6>
                </div>
            </div>
        </div>

        <!-- User Activity Log Card -->
        <div class="bg-white shadow-lg rounded-lg p-4">
            <div class="flex items-center">
                <div class="w-1/3 text-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-clock-history" viewBox="0 0 16 16">
                        <path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483m.53 2.507a6.991 6.991 0 0 0-.1-1.025l.985-.17c.067.386.106.778.116 1.17l-1 .025zm-.131 1.538c.033-.17.06-.339.081-.51l.993.123a7.957 7.957 0 0 1-.23 1.155l-.964-.267c.046-.165.086-.332.12-.501zm-.952 2.379c.184-.29.346-.594.486-.908l.914.405c-.16.36-.345.706-.555 1.038l-.845-.535m-.964 1.205c.122-.122.239-.248.35-.378l.758.653a8.073 8.073 0 0 1-.401.432l-.707-.707z"/>
                        <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0z"/>
                        <path d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5"/>
                    </svg>
                </div>
                <div class="w-2/3">
                    <h6 class="text-gray-500 font-semibold">User Activity Log</h6>
                    <h6 class="font-extrabold mb-0">
                        <span class="bg-red-500 text-white text-sm rounded-full px-3 py-1">{{ \App\Models\activityLog::count() }}</span>
                    </h6>
                </div>
            </div>
        </div>

        <!-- User Total Card -->
        <div class="bg-white shadow-lg rounded-lg p-4">
            <div class="flex items-center">
                <div class="w-1/3 text-green-500">
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664z"/>
                    </svg>
                </div>
                <div class="w-2/3">
                    <h6 class="text-gray-500 font-semibold">User Total</h6>
                    <h6 class="font-extrabold mb-0">
                        <span class="bg-red-500 text-white text-sm rounded-full px-3 py-1">{{ \App\Models\User::count() }}</span>
                    </h6>
                </div>
            </div>
        </div>

        <!-- Project Posts Card -->
        <div class="bg-white shadow-lg rounded-lg p-4">
            <div class="flex items-center">
                <div class="w-1/3 text-yellow-500">
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-clipboard-check" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M10.854 7.354a.5.5 0 0 0-.708 0L8 9.5 7.354 8.854a.5.5 0 1 0-.708.708l1 1a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0 0-.708z"/>
                        <path d="M10 1.5v1H9v-1h1zm-2 0v1H7v-1h1zm2-1h-1v1H9v-1h1zm-2 0H7v1h1v-1z"/>
                        <path d="M3.5 1a1 1 0 0 0-1 1v13a1 1 0 0 0 1 1h9a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1h-9zM2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2z"/>
                    </svg>
                </div>
                <div class="w-2/3">
                    <h6 class="text-gray-500 font-semibold">Project Posts</h6>
                    <h6 class="font-extrabold mb-0">
                        <span class="bg-red-500 text-white text-sm rounded-full px-3 py-1">{{ \App\Models\Product::count() }}</span>
                    </h6>
                </div>
            </div>
        </div>

    </section>
</div>
