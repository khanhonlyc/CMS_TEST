<div class="sidebar" data-color="white" data-active-color="danger">
  <div class="logo">
    <a href="{{ url('/') }}" class="text-white simple-text logo-normal" style="font-weight: 500; font-size: 18px; padding-top: 0.5rem; padding-bottom: 0.5rem; line-height: 1.625rem; ">
      {{ Auth::user()->user_name }} | {{ Auth::user()->permissionname['permission_name'] }}
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav menu" id="nav">
      @can('isAdmin')
        @include("inner.menu-1")
        @include("inner.menu-2")
        @include("inner.menu-3")
      @elsecan('isManager')
        @include("inner.menu-1")
      @else
        @include("inner.menu-2")
      @endcan
    </ul>
  </div>
</div>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="{{ secure_asset('css/metro-all.min.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet">
<style type="text/css">
  .sidebar .sidebar-wrapper li.active > a:not([data-toggle="collapse"]):before, .sidebar .sidebar-wrapper li.active > [data-toggle="collapse"] + div .nav li:before {
    content: none !important;
  }
  .sidebar .sidebar-wrapper li.active > a:not([data-toggle="collapse"]):after, .sidebar .sidebar-wrapper li.active > [data-toggle="collapse"] + div .nav li:after {
    content: none !important;
  }
  li.mypage.parent:not(.mainactive) .nc-minimal-down::before {
    content: "\ea3c";
  }
  #app {
    display: flex;
    flex-direction: column;
    height: 100vh;
  }
  .label-active {
    display: inline-block;
  }
  .label-active>label {
    padding: 5px 15px;
  }
  .main {
    flex: 1;
    display: flex;
    flex-direction: column;
  }
  .container-manament {
    flex: 1;
    display: flex;
    align-items: start;
    justify-content: center;
  }
  button.dropdown-toggle {
    padding: var(--bs-btn-padding-y) var(--bs-btn-padding-x) !important;
  }
  button.dropdown-toggle::before {
    content: none;
  }
  .form-check-input.permission {
    opacity: 0;
  }
  .form-check-input.permission:checked~.notactive {
    background: #fff;
  }
  .form-check-input.permission:checked~.active {
    background: #e0e0e0;
  }
  .form-check-input.permission:not(:checked)~.notactive {
    background: #e0e0e0;
  }
  .btn-pink {
    background-color: #d12b63;
    border: 1px solid #d12b63;
    color: #fff;
  }
  .btn-outline-pink {
    --bs-btn-color: #d12b63;
    --bs-btn-border-color: #d12b63;
    --bs-btn-hover-color: #fff;
    --bs-btn-hover-bg: #d12b63;
    --bs-btn-hover-border-color: transparent;
    --bs-btn-focus-shadow-rgb: 33, 37, 41;
    --bs-btn-active-color: #fff;
    --bs-btn-active-bg: #d12b63;
    --bs-btn-active-border-color: transparent;
    --bs-btn-active-shadow: inset 0 3px 5px rgb(209 43 99 / 90%);
    ;
    --bs-btn-disabled-color: #d12b63;
    --bs-btn-disabled-bg: transparent;
    --bs-btn-disabled-border-color: #d12b63;
    --bs-gradient: none;
  }
  #preview-image-before-upload {
    max-width: 250px;
    object-fit: cover;
  }
  #preview-image-before-upload.active {
    margin-right: 20px;
  }
  .select-status .form-select {
    max-width: 250px;
  }
  .text-start {
    text-align: left !important;
  }
  .form-select {
    display: block;
    width: 100%;
    padding: 0.375rem 2.25rem 0.375rem 0.75rem;
    -moz-padding-start: calc(0.75rem - 3px);
    font-size: 0.9rem;
    font-weight: 400;
    line-height: 1.6;
    color: #212529;
    background-color: #f8fafc;
    background-image: url(data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e);
    background-repeat: no-repeat;
    background-position: right 0.75rem center;
    background-size: 16px 12px;
    border: 1px solid #ced4da;
    border-radius: 0.375rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
  }
</style>
