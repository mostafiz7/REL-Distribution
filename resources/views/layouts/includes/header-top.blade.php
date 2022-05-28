<?php
  $settings = \App\Models\Settings_Model::count() == 1 ? \App\Models\Settings_Model::get()->first() : '';
?>
<section class="header-top fz-14">
  <div class="header-info">
    <div class="container-xl">
      <div class="row">
        <div class="col-6">
          <div class="info left">
            <p class="">
              <i class="fa fa-user"></i>
              @guest
                Welcome! Please
                @if ( Route::has('login') )
                  <a href="{{ route('login') }}" class="login">log in</a> or
                @endif
                
                @if ( Route::has('register') )
                  <a href="{{ route('register') }}" class="register">register</a>.
                @endif
              @endguest
              
              @if ( Auth::check() )
                <a href="{{ Auth::user()->role_id == 1 ? route('admin.dashboard') : route('members.home') }}" class="account">Account</a>
              @endif
            </p>
          </div>
        </div>
        <div class="col-6 text-end">
          <div class="info right">
            <p class="address">
              Find us at {{ $settings && $settings->company_address ? $settings->company_address['address_1'] : '' }},
              <span class="city">{{ $settings && $settings->company_address ? $settings->company_address['city'] : '' }}</span>,
              <span class="postcode">{{ $settings && $settings->company_address ? $settings->company_address['postcode'] : '' }}.</span>
              <i class="fa fa-map-marker"></i>
            </p>
            <p class="phone">
              Phone us on:
              <span class="contact-number">{{ $settings && $settings->company_contact ? $settings->company_contact : '' }}</span>
              <i class="fa fa-phone"></i>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="header-brand">
    <div class="container-xl">
      <div class="brand-content text-center">
        <a href="/" class="brand">
          <img src="{{ asset('assets/img/logo/logo-white.png') }}" alt="{{ $settings ? $settings->site_title : '' }}" class="logo" />
        </a>
      </div>
    </div>
  </div>
</section>