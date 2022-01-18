<div class="row">
  <div style="float: right; cursor: pointer;">
    <span class="fa fa-shopping-cart"><span id="product_items" class="float-right badge bg-primary">9</span></span>
  </div>  
</div>
<div class="row">
  <?php
  foreach($products as $product){
  ?>
  <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
    <div class="card bg-light d-flex flex-fill">
      <div class="card-header text-muted border-bottom-0">
        <?=$product->name?>
      </div>
      <div class="card-body pt-0">
        <div class="row">
          <div class="col-7">
            <h2 class="lead"><b>Nicole Pearson</b></h2>
            <p class="text-muted text-sm"><b>About: </b> Web Designer / UX / Graphic Artist / Coffee Lover </p>
            <ul class="ml-4 mb-0 fa-ul text-muted">
              <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Address: Demo Street 123, Demo City 04312, NJ</li>
              <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: + 800 - 12 12 23 52</li>
            </ul>
          </div>
          <div class="col-5 text-center">
            <img src="../../assets/dist/images/user1-128x128.jpg" alt="user-avatar" class="img-circle img-fluid">
          </div>
        </div>
      </div>
      <div class="card-footer">
        <div class="text-right">
          <button>-</button>
          <input type="text" value="1" size="3">
          <button>+</button>
          <a href="#" class="btn btn-sm bg-teal">
            <i class="fas fa-comments"></i>
          </a>
          <a class="btn btn-sm btn-primary add_product" data-product_id="<?=$product->id?>">
            <i class="fas fa-user"></i> View Profile
          </a>
        </div>
      </div>
    </div>
  </div>
  <?php
  }
  ?>
</div>

<script>
  $(".add_product").click(function(){
    $.get("product/add_to_cart?pid="+$(this).data("product_id"),function(data,status){
      console.log(data);
      console.log(status);
      $("#product_items").html(data);
    })
  })

</script>
