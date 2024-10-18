<div x-data="setup()" x-init="$refs.loading.classList.add('hidden');" @resize.window="watchScreen()">
      <div class="flex h-screen antialiased text-gray-900 bg-gray-100 dark:bg-dark dark:text-light">
        <!-- Loading screen -->
        <div x-ref="loading" class="fixed inset-0 z-50 flex items-center justify-center text-2xl font-semibold text-white bg-blue-800" >
          Loading.....
        </div>

        <!-- Sidebar -->
        <div class="flex flex-shrink-0 transition-all">
          <div x-show="isSidebarOpen" @click="isSidebarOpen = false" class="fixed inset-0 z-10 bg-black bg-opacity-50 lg:hidden"></div>
          <div x-show="isSidebarOpen" class="fixed inset-y-0 z-10 w-16 bg-white"></div>

          <!-- Mobile menu bottom bar -->
          <nav aria-label="Options" class="fixed inset-x-0 bottom-0 flex flex-row-reverse items-center justify-between px-4 py-2 bg-white border-t border-blue-100 sm:hidden shadow-t rounded-t-3xl">
            <!-- Menu button -->
            <button @click="(isSidebarOpen && currentSidebarTab == 'linksTab') ? isSidebarOpen = false : isSidebarOpen = true; currentSidebarTab = 'linksTab'" class="p-2 transition-colors rounded-lg shadow-md hover:bg-blue-800" :class="(isSidebarOpen && currentSidebarTab == 'linksTab') ? 'text-white bg-blue-800' : 'text-black bg-white'" >
                <span class="sr-only">Toggle sidebar</span>
                <i class="bi bi-text-right text-2xl"></i>
            </button>
            <!-- Logo -->
            <a href="#">
              <img class="w-20 h-auto" src="{{ asset('admin_assets/img/logo/imglogo.png') }}" alt="Gawang Gamat" />
            </a>
            <!-- User avatar button -->
            <div class="relative flex items-center flex-shrink-0 p-2" x-data="{ isOpen: false }">
              <button @click="isOpen = !isOpen; $nextTick(() => {isOpen ? $refs.userMenu.focus() : null})" class="transition-opacity rounded-lg opacity-80 hover:opacity-100 focus:outline-none focus:ring focus:ring-blue-800 focus:ring-offset-white focus:ring-offset-2" >
                <img class="w-10 h-10 rounded-lg shadow-md" src="{{url('admin_assets/img/pink.jpg')}}" alt="Profile" />
                <span class="sr-only">User menu</span>
              </button>
              <div x-show="isOpen" @click.away="isOpen = false" @keydown.escape="isOpen = false" x-ref="userMenu"  tabindex="-1" class="absolute w-48 py-1 mt-2 origin-bottom-left bg-white rounded-md shadow-lg left-10 bottom-14 focus:outline-none" role="menu" aria-orientation="vertical" aria-label="user menu">
                <a type="button" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 no-underline hover:no-underline" role="menuitem" data-bs-toggle="modal" data-bs-target="#profileModal">
                    Profile
                </a>
                <a href="{{ route('logout')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 no-underline hover:no-underline" role="menuitem">Log Out</a>
              </div>
            </div>
          </nav>

          <!-- Left mini bar -->
          <nav aria-label="Options" class="z-20 flex-col items-center flex-shrink-0 hidden w-16 py-4 bg-white border-r-2 border-blue-100 shadow-md sm:flex rounded-tr-3xl rounded-br-3xl">
            <!-- Logo -->
            <div class="flex-shrink-0 py-4">
              <a href="#">
                <img class="w-10 h-auto rounded-full" src="{{ asset('admin_assets/img/logo/logo.png') }}" alt="Gawang Gamat" />
              </a>
            </div>
            <!-- Menu button for the web -->
            <div class="flex flex-col items-center flex-1 p-2 space-y-4">
              <button @click="(isSidebarOpen && currentSidebarTab == 'linksTab') ? isSidebarOpen = false : isSidebarOpen = true; currentSidebarTab = 'linksTab'" class="p-2 transition-colors rounded-lg shadow-md hover:bg-blue-800" :class="(isSidebarOpen && currentSidebarTab == 'linksTab') ? 'text-white bg-blue-800' : 'text-black bg-white'" >
                <span class="sr-only">Toggle sidebar</span>
                <i class="bi bi-text-right text-2xl"></i>
              </button>
              <!-- Messages button -->
              <button @click="(isSidebarOpen && currentSidebarTab == 'messagesTab') ? isSidebarOpen = false : isSidebarOpen = true; currentSidebarTab = 'messagesTab'" class="p-2 transition-colors rounded-lg shadow-md hover:bg-blue-800"  :class="(isSidebarOpen && currentSidebarTab == 'messagesTab') ? 'text-white bg-blue-800' : 'text-black bg-white'"  >
                <span class="sr-only">Toggle message panel</span>
                <i class="bi bi-chat-square-text text-2xl"></i>
              </button>
              <!-- Notifications button -->
              <button @click="(isSidebarOpen && currentSidebarTab == 'notificationsTab') ? isSidebarOpen = false : isSidebarOpen = true; currentSidebarTab = 'notificationsTab'" class="p-2 transition-colors bg-gra rounded-lg shadow-lg hover:bg-blue-800" :class="(isSidebarOpen && currentSidebarTab == 'notificationsTab') ? 'text-white bg-blue-800' : 'text-black bg-white'" >
                <span class="sr-only">Toggle notifications panel</span>
                <i class="bi bi-bell text-2xl"></i>
              </button>
            </div>

            <!-- User avatar -->
            <div class="relative flex items-center flex-shrink-0 p-2" x-data="{ isOpen: false }">
              <button @click="isOpen = !isOpen; $nextTick(() => {isOpen ? $refs.userMenu.focus() : null})" class="transition-opacity rounded-lg opacity-80 hover:opacity-100 focus:outline-none focus:ring focus:ring-blue-800 focus:ring-offset-white focus:ring-offset-2"  >
                <img class="w-10 h-10 rounded-lg shadow-md" src="{{url('admin_assets/img/pink.jpg')}}" alt="Profile" />
                <span class="sr-only">User menu</span>
              </button>
              <div x-show="isOpen" @click.away="isOpen = false" @keydown.escape="isOpen = false" x-ref="userMenu" tabindex="-1" class="absolute w-48 py-1 mt-2 origin-bottom-left bg-white rounded-md shadow-lg left-10 bottom-14 focus:outline-none"  role="menu" aria-orientation="vertical" aria-label="user menu">
                <a type="button" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 no-underline hover:no-underline" role="menuitem" data-bs-toggle="modal" data-bs-target="#profileModal">
                    Profile
                </a>
                <a href="{{ route('logout')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 no-underline hover:no-underline" role="menuitem">Log Out</a>
              </div>
            </div>
          </nav>

          <div x-transition:enter="transform transition-transform duration-300" x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full" x-show="isSidebarOpen" class="fixed inset-y-0 left-0 z-10 flex-shrink-0 w-64 bg-white border-r-2 border-blue-100 shadow-lg sm:left-16 rounded-tr-3xl rounded-br-3xl sm:w-72 lg:static lg:w-64" >
            <nav x-show="currentSidebarTab == 'linksTab'" aria-label="Main" class="flex flex-col h-full">
                <!-- Logo -->
                <div class="flex items-center justify-center flex-shrink-0 py-10">
                    <a href="#">
                        <img class="w-24 h-auto" src="{{ asset('admin_assets/img/logo/imglogo.png') }}" alt="Gawang Gamat" />
                    </a>
                </div>
                <!-- Links -->
                <div class="flex-1 px-4 space-y-2 overflow-hidden hover:overflow-auto">
                    <a href="{{ route('dashboard') }}" class="flex items-center w-full space-x-2 text-white bg-blue-800 rounded-lg no-underline hover:no-underline">
                        <span aria-hidden="true" class="p-2 bg-blue-800 rounded-lg">
                            <i class="bi bi-house"></i>
                        </span>
                        <span>Home</span>
                    </a>
                </div>
            </nav>
            <section x-show="currentSidebarTab == 'messagesTab'" class="px-4 py-6">
              <h2 class="text-xl">Messages</h2>
            </section>

            <section x-show="currentSidebarTab == 'notificationsTab'" class="px-4 py-6">
              <h2 class="text-xl">Notifications</h2>
            </section>
          </div>
        </div>
        <div class="flex flex-col flex-1">
            <!-- Shadow Header  -->
          <header class="relative flex items-center justify-between flex-shrink-0 p-2"> 
            <form action="#" class="flex-1">
              <!--  -->
            </form>
            <!-- Mobile sub header menu button -->
            <button @click="isSubHeaderOpen = !isSubHeaderOpen" class="p-2 text-black bg-white rounded-lg shadow-md mr-7 sm:hidden hover:text-gray-800" >
              <span class="sr-only">More</span>
              <i class="bi bi-three-dots-vertical"></i>
            </button>

            <!-- Mobile sub header -->
            <div x-transition:enter="transform transition-transform" x-transition:enter-start="translate-y-full opacity-0" x-transition:enter-end="translate-y-0 opacity-100" x-transition:leave="transform transition-transform" x-transition:leave-start="translate-y-0 opacity-100" x-transition:leave-end="translate-y-full opacity-0" x-show="isSubHeaderOpen" @click.away="isSubHeaderOpen = false" class="" >
              <!-- Mobile Messages button -->
              <button @click="isSidebarOpen = true; currentSidebarTab = 'messagesTab'; isSubHeaderOpen = false" class="p-2 text-gray-400  rounded-lg shadow-md hover:text-gray-800 focus:outline-none focus:ring focus:ring-white focus:ring-offset-gray-100 focus:ring-offset-4" >
                <span class="sr-only">Toggle message panel</span>
                <i class="bi bi-chat-square-text text-2xl text-black"></i>
              </button>
              <!-- Notifications button -->
              <button @click="isSidebarOpen = true; currentSidebarTab = 'notificationsTab'; isSubHeaderOpen = false" class="p-2 text-gray-400 bg-white rounded-lg shadow-md hover:text-gray-800 focus:outline-none focus:ring focus:ring-white focus:ring-offset-gray-100 focus:ring-offset-4"  >
                <span class="sr-only">Toggle notifications panel</span>
                <i class="bi bi-bell text-2xl text-black"></i>
              </button>
            </div>
          </header>
        </div>
      </div>
      </section>
    </div>
</div>

<script>
const setup = () => {
    return {
    isSidebarOpen: false,
    currentSidebarTab: null,
    isSettingsPanelOpen: false,
    isSubHeaderOpen: false,
        watchScreen() {
            if (window.innerWidth <= 1024) {
            this.isSidebarOpen = false
            }
        },
    }
}
</script>
@include('components.profile-modal')