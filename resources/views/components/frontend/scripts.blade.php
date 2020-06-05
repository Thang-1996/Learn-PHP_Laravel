<script src="{{asset("js/jquery-3.3.1.min.js")}}"></script>
<script src="{{asset("js/bootstrap.min.js")}}"></script>
<script src="{{asset("js/jquery.nice-select.min.js")}}"></script>
<script src="{{asset("js/jquery-ui.min.js")}}"></script>
<script src="{{asset("js/jquery.slicknav.js")}}"></script>
<script src="{{asset("js/mixitup.min.js")}}"></script>
<script src="{{asset("js/owl.carousel.min.js")}}"></script>
<script src="{{asset("js/main.js")}}"></script>
{{--jax function--}}
<script type="text/javascript">
    function addToCart(productID) {
        $.ajax({
            url: "{{url("/cart/add/")}}/" + productID,
            method: "POST",
            data: {
                qty: 1,
                _token: "{{csrf_token()}}",
            },
            success: function () {
                alert("thanh cong");
            }
        });
    }
</script>
