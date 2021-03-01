<head>
  <title>My Cart</title>
  <style>
  .badge-notify{
    background:red;
    position:relative;
    top: -20px;
    right: 10px;
  }
  .my-cart-icon-affix {
    position: fixed;
    z-index: 999;
  }
  </style>
</head>

<body class="container">
  <div class="page-header">
    <h1>Products
      <div style="float: right; cursor: pointer;">
        <span class="glyphicon glyphicon-shopping-cart my-cart-icon"><span class="badge badge-notify my-cart-badge"></span></span>
      </div>
    </h1>
  </div>

<!--  <button type="addNewProduct" name="addNewProduct" id="addNewProduct">Add New Product</button> -->

  <div class="row">
  <?php 
  	foreach($products as $item){
  ?>
    <div class="col-md-3 text-center">
      <img src="../assets/products/images/<?php echo $item['image']?>" width="150px" height="150px">
      <br>
      <?php echo $item['name'].'<strong>$'.$item['id'].'</strong>'?>
      <br>
      <button class="btn btn-danger my-cart-btn" 
		data-id="<?php echo $item['id']?>" 
		data-name="<?php echo $item['name']?>" 
		data-summary="<?php echo $item['description']?>"
		data-price="<?php echo $item['dealer_price']?>"
		data-quantity="1" 
		data-image="../assets/products/images/<?php echo $item['image']?>"
	>Add to Cart</button>
      <button type="button" id="show-info" class="btn btn-info" data-toggle="modal" data-target="#modal-product-info"
		data-id="<?php echo $item['id']?>" 
		data-name="<?php echo $item['name']?>" 
		data-summary="<?php echo $item['description']?>"
		data-price="<?php echo $item['dealer_price']?>"
		data-quantity="1"
		data-image="../assets/products/images/<?php echo $item['image']?>"
	>Details</button>
	<span id="hidden_description" hidden><?php echo $item["remarks"]?></span>
    </div>
	
  <?php
  	}
  ?>
  </div>

<!-- Modal Product Details-->
<div class="modal fade" id="modal-product-info" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <strong>Id: </strong><span id="product_id"></span><br>
        <strong>Name: </strong><span id="product_name"></span><br>
        <strong>Intro: </strong><span id="product_intro"></span><br>
        <strong>Description: </strong><span id="product_description"></span><br>
        <strong>Image: </strong><img src="" id="product_image"></img><br>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script>
$('#modal-product-info').on('shown.bs.modal', function () {
	$('#product_id').text($("#show-info").data("id"));
	$('#product_name').text($("#show-info").data("name"));
	$('#product_intro').text($("#show-info").data("summary"));
	$('#product_description').text($("#hidden_description").text());
	$('#product_image').attr("src", $("#show-info").data("image"));
})
</script>

  <script type="text/javascript">
  $(function($){


    var goToCartIcon = function($addTocartBtn){
      var $cartIcon = $(".my-cart-icon");
      var $image = $('<img width="30px" height="30px" src="' + $addTocartBtn.data("image") + '"/>').css({"position": "fixed", "z-index": "999"});
      $addTocartBtn.prepend($image);
      var position = $cartIcon.position();
      $image.animate({
        top: position.top,
        left: position.left
      }, 500 , "linear", function() {
        $image.remove();
      });
    }

    $('.my-cart-btn').myCart({
      currencySymbol: '$',
      classCartIcon: 'my-cart-icon',
      classCartBadge: 'my-cart-badge',
      classProductQuantity: 'my-product-quantity',
      classProductRemove: 'my-product-remove',
      classCheckoutCart: 'my-cart-checkout',
      affixCartIcon: true,
      showCheckoutModal: true,
      numberOfDecimals: 2,
      cartItems: [
      /*
        {id: 1, name: 'product 1', summary: 'summary 1', price: 10, quantity: 1, image: '/assets/image_product/img_1.png'},
        {id: 2, name: 'product 2', summary: 'summary 2', price: 20, quantity: 2, image: '/assets/image_product/img_2.png'},
        {id: 3, name: 'product 3', summary: 'summary 3', price: 30, quantity: 1, image: '/assets/image_product/img_3.png'}
*/        
      ],
      clickOnAddToCart: function($addTocart){
        goToCartIcon($addTocart);
      },
      afterAddOnCart: function(products, totalPrice, totalQuantity) {
        console.log("afterAddOnCart", products, totalPrice, totalQuantity);
      },
      clickOnCartIcon: function($cartIcon, products, totalPrice, totalQuantity) {
        console.log("cart icon clicked", $cartIcon, products, totalPrice, totalQuantity);
      },
      checkoutCart: function(products, totalPrice, totalQuantity) {
        var checkoutString = "Total Price: " + totalPrice + "\nTotal Quantity: " + totalQuantity;
        checkoutString += "\n\n id \t name \t summary \t price \t quantity \t image path";
        $.each(products, function(){
          checkoutString += ("\n " + this.id + " \t " + this.name + " \t " + this.summary + " \t " + this.price + " \t " + this.quantity + " \t " + this.image);
        });
        alert(checkoutString);
        //console.log("checking out", products, totalPrice, totalQuantity);
  commitOrder(checkoutString);
      },
      getDiscountPrice: function(products, totalPrice, totalQuantity) {
        console.log("calculating discount", products, totalPrice, totalQuantity);
        return totalPrice * 1;
      }
    });

    $("#addNewProduct").click(function(event) {
      var currentElementNo = $(".row").children().length + 1;
      $(".row").append('<div class="col-md-3 text-center"><img src="/assets/image_product/img_empty.png" width="150px" height="150px"><br>product ' + currentElementNo + ' - <strong>$' + currentElementNo + '</strong><br><button class="btn btn-danger my-cart-btn" data-id="' + currentElementNo + '" data-name="product ' + currentElementNo + '" data-summary="summary ' + currentElementNo + '" data-price="' + currentElementNo + '" data-quantity="1" data-image="/assets/image_product/img_empty.png">Add to Cart</button><a href="#" class="btn btn-info">Details</a></div>')
    });
  });

   function commitOrder(checkoutString){
  alert(checkoutString+"jose");

  $.post( "cart/add", {user_id: 1, product_id: 1, price:145, qty:7})
    .done(function( data ) {
      alert( "Data Loaded: " + data );
  });
   }

   function commitOrder2(){
     $.ajax({
       type: "POST",
       url: "/admin/cart/add",
       data: {'user_id':'1', 'product_id':'1', 'price':145, 'qty':'7'},
       success: function(data){
         if (data == 'true'){
           alert("Thanks your order");
         }else{
           alert("Order not success!");
         }
      }
    });//ajax
   }//function commitOrder2

  </script>

