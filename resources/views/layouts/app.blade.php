@extends('layouts.base')

@section('body')
<div class="flex h-screen overflow-y-hidden bg-white" x-data="setup()" x-init="$refs.loading.classList.add('hidden')">
  @include('layouts.app.nav')

  <div class="flex flex-col flex-1 h-full overflow-hidden">

    @include('layouts.app.header')

    @yield('content')

    @include('layouts.app.footer')

    {{-- @include('layouts.app.settings') --}}

  </div>

  @isset($slot)
  {{ $slot }}
  @endisset
</div>

<script>
  const setup = () => {
    return {
      loading: true,
      isSidebarOpen: true,
      toggleSidbarMenu() {
        this.isSidebarOpen = !this.isSidebarOpen
      },
      isSettingsPanelOpen: false,
      isSearchBoxOpen: false,
      }
    }
</script>
@endsection