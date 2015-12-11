{{-- {!! HTML::script('https://www.google.com/recaptcha/api.js') !!} --}}
<script src="https://www.google.com/recaptcha/api.js?onload=CaptchaCallback&render=explicit" async defer></script>
<script type="text/javascript">
var CaptchaCallback = function(){
$('.g-recaptcha').each(function(index, el) {
    grecaptcha.render(el, {'sitekey' : '{{ env('RE_CAP_SITE') }}'});
});
};
</script>
