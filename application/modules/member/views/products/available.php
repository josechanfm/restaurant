<div class="row">
  <div class="col-md-12">
    <div class="pull-right">
      <span id="shopping_cart" class="fa fa-shopping-cart fa-3x"></span>
      <span id="product_cart" class="float-right badge bg-primary">0</span>
    </div>
  </div>
</div>
<div class="row">
  <?php
  foreach($products as $product){
  ?>
  <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
    <div class="card bg-light d-flex flex-fill">
      <div class="card-header border-bottom-0">
        <?=$product->name?>
      </div>
      <div class="card-body pt-0">
        <div class="row">
          <div class="col-7">
            <h2 class="lead"><b><?=$product->brand?></b></h2>
            <p class="text-muted text-sm">
              <?=mb_substr(strip_tags(trim($product->description)),0,50)."..."?>
            </p>
            <ul class="ml-4 mb-0 fa-ul text-muted">
              <li class="small">
                <span class="fa-li">
                  <i class="fas fa-barcode"></i>
                </span> Barcode: <?=$product->barcode?>
              </li>
              <!-- <li class="small">
                <span class="fa-li">
                  <i class="fas fa-boxes"></i>
                </span> Volume: <?=$product->volume?>
              </li> -->
            </ul>
          </div>
          <div class="col-5 text-center">
            <img src="../../assets/products/images/<?=$product->image?>" alt="user-avatar" class="img-circle img-fluid">
          </div>
        </div>
      </div>
      <div class="card-footer">
        <div class="text-right product_item">
          <button class="product_less">-</button>

          <input type="number" name="product_qty" value="1" class="text-center" data-volume="<?=$product->volume?>" max="<?=$product->volume?>">

          <button class="product_more">+</button>
          <a class="btn btn-sm btn-primary product_add" data-product_id="<?=$product->id?>" data-product_name="<?=$product->name?>">
            <i class="fas fa-plus"></i> Add
          </a>
        </div>
      </div>
    </div>
  </div>
  <?php
  }
  ?>
</div>




<div class="modal fade" id="cart_modal" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Extra Large Modal</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form id="product_list_form">
        <div class="modal-body">
          <table id="product_list" class="table">
            <thead>
              <tr>
                <th>qty</th>
                <th>name</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
          <div class="row">
            <div class="col-md-8">
              <label>Loaner</label>
              <input type="text" name="loaner_name" class="form-control">
            </div>
            <div class="col-md-4">
              <label>Contact</label>
              <input type="text" name="loaner_contact" class="form-control">
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <label>Date Start</label>
              <input type="date" name="date_start" value="" class="form-control">
            </div>
            <div class="col-md-6">
              <label>Date Return</label>
              <input type="date" name="date_end" value="" class="form-control">
            </div>
          </div>
          <label class="label">Remark</label>
          <textarea name="remark" class="form-control"></textarea>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" id="submit">Save changes</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>


<script>

var products = <?=json_encode($products)?>;
console.log(products)

  $(".product_more").click(function(){
    qty_input = $(this).parent().find("input[name='product_qty']")

    volume = qty_input.data("volume")

    qty = parseInt( qty_input.val() )

    // 沒有入volume就不限qty    
    if( volume == null || volume == "" ){
      qty_input.val(qty+1); 
    }else if( (qty+1) > volume ){
      qty_input.effect("shake", { times:2 }, 10);
    }
    
  })
  $(".product_less").click(function(){
    product_qty=parseInt($(this).parent().find("input[name='product_qty']").val());
    if(product_qty>1){
      $(this).parent().find("input[name='product_qty']").val(product_qty-1);
    }
  })
  $("#shopping_cart").click(function(){
    $("#cart_modal").modal("show");
  })

  $("input[name=product_qty]").change(function(){
    //Can not bigger than volume
    // if( $(this).val() > $(this).data("volume") ){
    //   $(this).val( $(this).data("volume") )
    // }
  })

  $("#submit").click(function(){
    pid=$("#product_list_form input[name='pid']").serializeArray();
    qty=$("#product_list_form input[name='qty']").serializeArray();
    loaner={
      name:$("#product_list_form input[name='loaner_name']").val(),
      contact:$("#product_list_form input[name='loaner_contact']").val(),
      date_start:$("#product_list_form input[name='date_start']").val(),
      date_end:$("#product_list_form input[name='date_end']").val(),
      remark:$("#product_list_form textarea[name='remark']").val(),
    };
    list=[];
    $.each(pid,function(index,p){
      list.push({loaner_id:'',pid:p.value,qty:qty[index].value});
    })

    $.post("lent/product/checkout",{items:list,loaner:loaner})
      .done(function(data,status){
        console.log(data);
        $("#cart_modal").modal("hide");
      })
  })

  $(".product_add").click(function(){
    pid=$(this).data("product_id");
    qty=$(this).parent().find("input[name='product_qty']").val();
    product_name=$(this).data("product_name")

    tr=$("#product_list tbody").append("<tr></tr>");
    td=$("#product_list tr:last").append("<td>"+
      "<input type='hidden' name='pid' value='"+pid+"'>"+
      "<input type='text' name='qty' value='"+qty+"' size='2' class='text-center'>"+
      "</td>");
    td=$("#product_list tr:last").append("<td>"+product_name+"</td>");

    $("#product_cart").html($("#product_list tbody>tr").length);
  })

</script>


<style>
input[type=number]{
  width: 70px;
}

input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

</style>
