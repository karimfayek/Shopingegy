<footer id="site-footer" class="site-footer">
    <div class="footer">
        <div class="section-padding">
            <div class="section-container">
                <div class="block-widget-wrap">
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="block block-image">
                                <img width="100" height="22" src="/storage/{{ config('settings.site_logo') }}" alt="{{ config('settings.site_name') }}">
                            </div>
                            <div class="block block-social">
                                <ul class="social-link">
                                    @if(config('settings.social_facebook') != "#" )
                                    <li><a href="{{ config('settings.social_facebook') }}"><i class="fa fa-facebook"></i></a></li>
                                    @endif
                                    @if(config('settings.social_twitter') != "#" )
                                    <li><a href="{{ config('settings.social_twitter') }}"><i class="fa fa-twitter"></i></a></li>
                                    @endif
                                    @if( config('settings.social_instagram') != "#" )
                                    <li><a href="{{ config('settings.social_instagram') }}"><i class="fa fa-instagram"></i></a></li>
                                    @endif
                                    @if( config('settings.social_linkedin') != "#" )
                                    <li><a href="{{ config('settings.social_linkedin') }}"><i class="fa fa-linkedin"></i></a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="block block-menu">
                                <h2 class="block-title">{{ $heading['contactinfo'] }}</h2>
                                <div class="block-content">
                                  
                                    <ul>
                                        <li>
                                            <a href="tel:{{ config('settings.phones') }}"> {{ config('settings.phones') }}</a>
                                        </li>
                                        <li>
                                            <a href="mailto:{{ config('settings.default_email_address') }}">
                                                {{ config('settings.default_email_address') }}
                                            </a>
                                        </li>
                                      
                                    </ul>
                                   
                                </div>
                            </div>
                           
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="block block-menu">
                                <h2 class="block-title">{{ $heading['links'] }}</h2>
                                <div class="block-content">
                                    <ul>
                                        
                                        @foreach ($footer as $f)
                                        <li>
                                            <a href="/page/{{ $f->slug }}/{{ $local }}">{{ $f->LocalName }}</a>
                                        </li>
                                           
                                        @endforeach
                                        
                                       
                                    
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="block block-newsletter" >
                                <h2 class="block-title">{{ $heading['nlsub'] }}</h2>
                                <div class="block-content">
                                    <div class="newsletter-text">{{ $heading['nltext']}}</div>
                                    
                                    <div id="subscription-form-2"  class="newsletter-form">
                                        <input type="email" id="email-2" name="email" autocomplete="off" placeholder="{{ $heading['email'] }}">
                                        <span class="clearfix">
                                            <input type="submit" data-form-id="subscription-form-2" class="btn-submit" value="{{ $heading['subscribe'] }}"
                                                style="
                                                        background: #000;
                                                        color: #fff;
                                                        padding: 8px;
                                                        margin-left: .052083333in;
                                                        position: relative;
                                                        cursor : pointer
                                                "
                                            >
                                        </span>
                                    </form>
                                    
                                   
                                </div>
                                <!-- mailchimp-alerts Start -->
                                <div class="mailchimp-alerts" >
                                    <div class="mailchimp-submitting"></div><!-- mailchimp-submitting end -->
                                    <div class="mailchimp-success" id="success-message-2" style="
                                    margin-top: 8px;
                                    border: 1px solid green;
                                    padding: 10px;
                                    font-weight: bold;
                                    letter-spacing: 1px;
                                    display:none
                                "></div><!-- mailchimp-success end -->
                                    <div class="mailchimp-error"></div><!-- mailchimp-error end -->
                                </div>
                                <!-- mailchimp-alerts end -->
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="section-padding">
            <div class="section-container">
                <div class="block-widget-wrap">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="footer-left">
                                <p class="copyright">Copyright © 2024. {{ $heading['copyright'] }} <b>by  <a href="#s">ShopingEGY</a></b></p>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

@push('scripts')

<script>
    jQuery(document).ready(function($){
        $('.btn-submit').on('click', function (e) {
    e.preventDefault();

    var formId = $(this).data('form-id');
    var email = $('#' + formId + ' input[type="email"]').val();
    var successMessageId = 'success-message-' + formId.split('-').pop();

    $.ajax({
        url: '/newsletter/subscribe',
        data: { "action": "NewsLetter", email: email, lang: '{{ $local }}' },
        method: "post",
        beforeSend: function (xhr) {
            var token = '{{ csrf_token() }}';

            if (token) {
                return xhr.setRequestHeader('X-CSRF-TOKEN', token);
            }
        },
        success: function (result) {
            $('#' + successMessageId).show().html(result);
        }
    });
});

});
   
    </script>
    
@endpush
                          