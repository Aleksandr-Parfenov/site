<footer id="footer"><!--Footer-->
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <p class="pull-left">Copyright © 2020</p>
                <p class="pull-right">Elena Parfenava</p>
            </div>
        </div>
    </div>
</footer><!--/Footer-->




<script src="/template/js/jquery.js"></script>
<script src="/template/js/jquery.cycle2.min.js"></script>
<script src="/template/js/jquery.cycle2.carousel.min.js"></script>
<script src="/template/js/bootstrap.min.js"></script>
<script src="/template/js/jquery.scrollUp.min.js"></script>
<script src="/template/js/price-range.js"></script>
<script src="/template/js/jquery.prettyPhoto.js"></script>
<script src="/template/js/main.js"></script>


<script>
    $(document).ready(function(){
        $('[data-btn="add-to-cart"]').click(function () {
            var id = $(this).attr("data-id");
            var countIdProduct = $('input[data-btn="add-to-cart-value"]').val();
            $.post("/cart/addProductAjax/"+id, {countIdProduct}, data=> {
                var c = JSON.parse(data);
                $('[data-btn=\'subtract-from-cart-id'+id+'\']').html(c['cartCountIdProduct']);
                $('[data-cart="count"]').html(c['cartCountItems']);
                $("#cart-total-price").html(c['cartTotalPrice']);
            });
            return false;
        });

        $('[data-btn="subtract-from-cart"]').click(function () {
            var id = $(this).attr("data-id");
            $.post("/cart/subtractAjax/"+id, {}, data=> {
                var c = JSON.parse(data);
                $('[data-btn=\'subtract-from-cart-id'+id+'\']').html(c['cartCountIdProduct']);
                $('[data-cart="count"]').html(c['cartCountItems']);
                $("#cart-total-price").html(c['cartTotalPrice']);
                if (c['cartCountItems'] == 0) {
                    location.href = '/cart/';
                }
            });
            return false;
        });

        $('[data-btn="subtract-all-product-from-cart"]').click(function () {
            var id = $(this).attr("data-id");
            var deleteAllProduct = 1;
            $.post("/cart/subtractAjax/"+id, {deleteAllProduct}, data=> {
                var c = JSON.parse(data);
                $('[data-btn=\'subtract-from-cart-id'+id+'\']').html(c['cartCountIdProduct']);
                $('[data-btn=\'delete-line-cart-id'+id+'\']').html('');
                $('[data-cart="count"]').html(c['cartCountItems']);
                $("#cart-total-price").html(c['cartTotalPrice']);
                if (c['cartCountItems'] == 0) {
                    location.href = '/cart/';
                }
            });
            return false;
        });
    });
</script>


</body>
</html>
