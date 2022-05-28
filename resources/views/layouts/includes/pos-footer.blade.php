<footer class="site-footer p-fixed pos-bottom-left w-100 bg-white" id="POS-Footer">
  <div class="footer-area">

    {{--@if ( strpos($viewName, 'pos-module') )
      @include( 'layouts.includes.pos-footer' )
    @endif--}}

    <div class="pos-footer">
      <div class="container-fluid">
        <div class="row justify-content-between">
          <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="site-copyright fz-14 text-secondary">
              <div class="copyright-text py-20 lh-1">
                © Noor-POS || All rights reserved.
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="footer-clock d-flex justify-content-center align-items-center bg-purple py-7">
              <div class="clock-icon w-40px h-40px bg-white text-purple fz-22 text-center lh-1-8 mr-30 brd-3">
                <i class="far fa-clock"></i>
              </div>
              <div class="clock-time">
                <div id="clock-footer" class="text-white fw-bold"></div>
                <div id="date-footer" class="text-white fz-10"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>