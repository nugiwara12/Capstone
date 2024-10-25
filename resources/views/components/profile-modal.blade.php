<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="profileModalLabel">Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Add more fields as needed -->
                <div class="text-sm leading-6">
                    <figure class="relative flex flex-col-reverse bg-slate-100 rounded-lg p-6 dark:bg-slate-800 dark:highlight-white/5">
                        <blockquote class="mt-6 text-slate-700 dark:text-slate-300">
                            <p>{{ Auth::user()->description }}</p>
                        </blockquote>
                        <figcaption class="flex items-center space-x-4">
                            <img src="{{url('admin_assets/img/pink.jpg')}}" alt="Profile picture" class="flex-none w-14 h-14 rounded-full object-cover" loading="lazy" decoding="async">
                            <div class="flex-auto">
                                <div class="text-base text-slate-900 font-semibold dark:text-slate-200 uppercase">
                                    {{ Auth::user()->name }}
                                </div>
                                <div class="mt-0.5 dark:text-slate-300">
                                    {{ Auth::user()->email }}
                                </div>
                                <div class="mt-0.5 dark:text-slate-300">
                                    {{ Auth::user()->phone }}
                                </div>
                                <div class="mt-0.5 dark:text-slate-300">
                                    {{ Auth::user()->role }}
                                </div>
                            </div>
                        </figcaption>
                    </figure>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

