<!-- Footer -->
<footer class="bg-light text-center text-lg-start">
    <!-- Grid container -->
    <div class="container p-4">
      <!--Grid row-->
      <div class="row">
        <!--Grid column-->
        <div class="col-6">
            <ul class="list-unstyled">
                <li>
                    <a class="navbar-brand" href="{{route('index')}}">
                        <img src="/images/logo_text.png" alt="" height="35">
                    </a>
                </li>
                <li>
                    <!--
                    <p>{{__('identity.footer_text')}}</p>
                    -->
                </li>
                <li>
                    @include('inc.lang_picker')
                </li>
                <li>
                    <a class="text-dark" href="{{route('legal.sitemap')}}">{{__('seo.sitemap')}}</a>
                </li>
                <li>
                    <a class="text-dark" href="{{route('legal.privacy')}}">{{__('legal.privacy_policy')}}</a>
                </li>
                <li>
                    <a class="text-dark" href="{{route('legal.terms')}}">{{__('legal.terms_of_service')}}</a>
                </li>
            </ul>
        </div>
        <!--Grid column-->

        <!--Grid column-->

        <!--Grid column-->

        <!--Grid column-->
        <div class="col-6">
          <h5 class="text-uppercase">{{trans_choice('text.link', 2)}}</h5>
          <ul class="list-unstyled">
            <li>
                <a href="{{route('listing.index')}}" class="text-dark"><i class="fa fa-list"></i> {{trans_choice('text.ad', 2)}}</a>
            </li>
            <li>
                <a href="{{route('listing.create')}}" class="text-dark"><i class="fa fa-pen"></i> {{__('text.create_new_listing')}}</a>
            </li>
            <li>
              <a href="{{route('hotline.index')}}" class="text-dark"><i class="fa fa-fire"></i> {{__('page.hotline')}}</a>
            </li>
            <li>
                <a href="{{route('vip')}}" class="text-dark"><i class="fa fa-crown"></i> {{__('text.become_vip_now')}}</a>
            </li>
            <li>
                <div class="row d-flex justify-content-center mt-2">
                    <a href="{{config('social.facebook_page_link')}}" class="fab fa-facebook fa-2x mr-1"></a>
                    <a href="mailto:{{config('social.email')}}" class="fa fa-envelope fa-2x mr-1"></a>
                </div>
            </li>

          </ul>
        </div>
        <!--Grid column-->
      </div>
      <!--Grid row-->
    </div>
    <!-- Grid container -->

    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
        © {{date("Y")}} {{env('APP_URL')}}
    </div>
    <!-- Copyright -->
  </footer>
  <!-- Footer -->
