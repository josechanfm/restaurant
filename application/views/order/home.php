<div id="mySidebar" class="sidebar">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
  <?php  foreach($categories as $category):  ?>
    <a href="#">About</a>
  <?php endforeach?>
  
</div>

<div id="main">
  <div class="card">
    <div class="card-header border-0">
      <button class="openbtn" onclick="openNav()">☰ Order</button>  
      
      <div class="card-tools">
        <a href="#" class="btn btn-sm btn-tool">
          <i class="fa fa-shopping-cart"></i>
          <span class="badge badge-danger navbar-badge" id="products_ordered">0</span>
        </a>
      </div>
    </div>
    <div class="card-body">
      <?php 
      foreach($products as $product):
      ?>
        <div class="row">
            <div class="col-4">
              <img src="./uploads/products/images/<?=$product->image?>" class="dish_image">
            </div>
            <div class="col-8">
              <div class="dish_title"><?=$product->name?></div>
              <div>
                <span class="dish_price">MOP$<?=$product->price?></span>
                <span class="dish_order pull-right">
                  <span class="badge badge-danger navbar-badge product_ordered" id="p<?=$product->id?>" style="display:none">0</span>
                  <a class="product_minus" data-product_id="<?=$product->id?>"><i class="fa fa-minus"></i></a>
                  <a class="product_plus" data-product_id="<?=$product->id?>"><i class="fa fa-plus"></i></a>
                </span>
              </div>
              <div class="dish_favour">
                <button type="button" class="btn btn-default btn-sm">Steak</button>
                <button type="button" class="btn btn-default btn-sm">Steak</button>
              </div>
            </div>
        </div>
        <hr>
      <?php endforeach;?>



    </div>
  </div>
</div>

<div class="footer">
      <div class="navbar">
        <a href="#home" class="active"><i class="fa fa-home"></i></a>
        <a href="#"><i class="fa fa-commenting-o"></i></a>
        <a href="#"><i class="fa fa-list"></i></a>
        <a href="#"><i class="fa fa-user"></i></a>
        <a href="#"><i class="fa fa-shopping-cart"></i></a>
      </div>

    </div>

<script>
  products={};
  $(document).on("click",".product_plus",function(){
    selected='p'+$(this).data("product_id");
    console.log(products[selected]);
    if(products[selected]===undefined){
      products[selected]=1;
      console.log('add new');
    }else{
      products[selected]=products[selected]+1;
      console.log('add more');
    }
    refresh_cart();
  })
  $(document).on("click",".product_minus",function(){
    selected='p'+$(this).data("product_id");
    if(products[selected]!==undefined){
      if(products[selected]>0){
        products[selected]-=1;
        console.log('minus one');
      }
    }
    refresh_cart();
  })

  function refresh_cart(){
    $(".product_ordered").hide();
    count=0;
    $.each(products, function(index,value){
      if(value>0){
        $("#"+index).show();
        $("#"+index).text(value);
      }
      count+=value;
    })
    $("#products_ordered").text(count);

  }

  function openNav() {
    document.getElementById("mySidebar").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
  }
  function closeNav() {
    document.getElementById("mySidebar").style.width = "0";
    document.getElementById("main").style.marginLeft = "0";
  }
</script>


<style>
  body {
    font-family: "Lato", sans-serif;
  }
  .btn .badge {
    position: relative;
    top: -15px;
    left: -15px;
    font-size: 15px;
  }  
  .dish_image{
    width:100%;
    min-height:100px;
  }
  .dish_order i{
    background-color: blanchedalmond;
    border-radius: 100px;
    padding: 10px;
    color:darkorange;
  }
  .dish_favour{
    position:absolute;
    bottom:0;
  }
  .dish_favour button{
    padding: 0rem 0.5rem;
  }
  .card-tools a{
    font-size:30px;
  }
  .sidebar {
    height: 89vh;
    width: 0;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    background-color: blanchedalmond;
    overflow-x: hidden;
    transition: 0.5s;
    padding-top: 60px;
  }

  .sidebar a {
    padding: 8px 8px 8px 32px;
    text-decoration: none;
    font-size: 25px;
    color: #818181;
    display: block;
    transition: 0.3s;
  }

  .sidebar a:hover {
    color: #f1f1f1;
  }

  .sidebar .closebtn {
    position: absolute;
    top: 0;
    right: 25px;
    font-size: 36px;
    margin-left: 50px;
  }

  .openbtn {
    font-size: 20px;
    cursor: pointer;
    background-color: #111;
    color: white;
    padding: 10px 15px;
    border: none;
  }
  .openbtn:hover {
    background-color: #444;
  }



  .navbar {
    overflow: hidden;
    background-color: white;
    position: fixed;
    bottom: 0;
    width: 100%;
  }

  .navbar a {
    float: left;
    display: block;
    color: darkgray;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    font-size: 30px;
  }

  .navbar a:hover {
    background: #f1f1f1;
    color: black;
  }

  .navbar a.active {
    background-color: #04AA6D;
    color: white;
  }


  #main {
    transition: margin-left .5s;
    padding: 16px;
  }

  /* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
  @media screen and (max-height: 450px) {
    .sidebar {padding-top: 15px;}
    .sidebar a {font-size: 18px;}
  }
</style>
