<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Lent items</h3>
        <div class="card-tools">
          <div class="input-group input-group-sm" style="width: 150px;">
            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

            <div class="input-group-append">
              <button type="submit" class="btn btn-default">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
          <thead>
            <tr>
              <th>Loaner</th>
              <th>Product name</th>
              <th>QTY</th>
              <th>Start date</th>
              <th>Return date</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($products as $product){
            ?>
              <tr data-record='<?=json_encode($product)?>'>
                <td class="loaner_name"><?=$product->loaner_name?></td>
                <td class="product_name"><?=$product->product_name?></td>
                <td><?=$product->qty?></td>
                <td><?=$product->date_start?></td>
                <td><?=$product->date_end?></td>
              </tr>

            <?php
            }
            ?>
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
</div>




      <div class="modal fade" id="info_modal" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Extra Large Modal</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              ......
            </div>
            <div class="modal-footer justify-content-between">
              <span></span>
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>


<script>
$(".loaner_name").click(function(){
  $("#info_modal .modal-body").empty();
  $("#info_modal .modal-body").append($(this).parent().data("record")['loaner_name']);;
  $("#info_modal").modal("show");
})
$(".product_name").click(function(){
  $("#info_modal .modal-body").empty();
  $("#info_modal .modal-body").append('<p>'+$(this).parent().data("record")['product_name']+"</p>");
  $("#info_modal .modal-body").append('<p>'+$(this).parent().data("record")['product_description']+"</p>");
  $("#info_modal").modal("show");
})

</script>