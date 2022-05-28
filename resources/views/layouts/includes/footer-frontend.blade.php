<div class="footer-wrapper">
  <div class="container-lg">
    <div class="row">

      <div class="col-lg-4 col-md-6 col-12 order-lg-1 order-3 text-md-start text-center py-20 py-lg-0">
        <div class="copyright">
          <div class="copyright-text">
            Copyright &copy; <span class="year">{{ date('Y') }}</span>
            <a href="/" class="company text-capitalize">
              @if ( \App\Models\Settings_Model::count() == 1 )
                {{ \App\Models\Settings_Model::get()->first()->site_title }}
              @endif
            </a>, All Rights Reserved.
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6 col-12 order-lg-2 order-1 text-md-start text-center py-20 py-lg-0">
        <div class="payment-methods">
          <img class="image" src="{{ asset('assets/img/footer/payments-accepted-all.png') }}" alt="Noor-Restaurant Accepted Payment Methods" />
        </div>
      </div>

      <div class="col-lg-3 col-md-6 col-12 order-lg-3 order-2 text-md-end text-center py-20 py-lg-0">
        <div class="footer-links">
          <div>
            <a href="/" class="nav-link">Help</a>
            <a href="/" class="nav-link">Policies</a>
            <a href="/" class="nav-link">Terms &amp; Conditions</a>
          </div>
        </div>
      </div>

      <div class="col-lg-2 col-md-6 col-12 order-4 text-md-end text-center py-20 py-lg-0">
        <div class="powered-by">
          {{--<a href="/" class="vendor-logo">
            <img src="{{ asset('assets/img/footer/powerd-by-Logo_zpos.png') }}" alt="Powered by Logo" />
          </a>--}}
        </div>
      </div>

    </div>
  </div>
</div>