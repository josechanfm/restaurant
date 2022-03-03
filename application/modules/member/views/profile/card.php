<?php $this->load->view('card_header')?>


<div class="row">
  <div class="col-md-6 col-12">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Collapsible Card Example</h3>
        <div class="card-tools">
          <!-- Collapse Button -->
          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
        </div>
        <!-- /.card-tools -->
      </div>
      <!-- /.card-header -->
      <div class="card-body">
                <ul class="products-list product-list-in-card pl-2 pr-2">
                  <li class="item">
                    <div class="product-img">
                      <img src="../../assets/dist/images/default-150x150.png" alt="Product Image" class="img-size-50">
                    </div>
                    <div class="product-info">
                      <a href="./contest/item/" class="product-title">Contest 1 title
                        <span class="badge badge-warning float-right">2</span></a>
                      <span class="product-description">
                        Contest 1
                      </span>
                    </div>
                  </li>
                  <!-- /.item -->
                </ul>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->

    <div class="card card-success collapsed-card">
      <div class="card-header">
        <h3 class="card-title">Collapsible Card Example</h3>
        <div class="card-tools">
          <!-- Collapse Button -->
          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
        </div>
        <!-- /.card-tools -->
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        The body of the card
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->

  </div>
</div>




<div class="row">
  <div class="col-md-6 col-12">
      <div id="accordion">
        <div class="card card-primary">
          <div class="card-header">
            <h4 class="card-title w-100">
              <a class="d-block w-100 collapsed" data-toggle="collapse" href="#collapseOne" aria-expanded="false">
                Contest List
              </a>
            </h4>
          </div>
          <div id="collapseOne" class="collapse" data-parent="#accordion" style="">
            <div class="card-body p-0">
                <ul class="products-list product-list-in-card pl-2 pr-2">
                  <li class="item">
                    <div class="product-img">
                      <img src="../../assets/dist/images/default-150x150.png" alt="Product Image" class="img-size-50">
                    </div>
                    <div class="product-info">
                      <a href="./contest/item/" class="product-title">Contest 1 title
                        <span class="badge badge-warning float-right">2</span></a>
                      <span class="product-description">
                        Contest 1
                      </span>
                    </div>
                  </li>
                  <!-- /.item -->
                </ul>
            </div>
          </div>
        </div>
        <div class="card card-danger">
          <div class="card-header">
            <h4 class="card-title w-100">
              <a class="d-block w-100" data-toggle="collapse" href="#collapseTwo">
                Awards
              </a>
            </h4>
          </div>
          <div id="collapseTwo" class="collapse" data-parent="#accordion">
            <div class="card-body">
              <table width="100%">
                <tr>
                  <th>Sales Amount</th>
                  <td>$4,566,568</td>
                </tr>
                <tr>
                  <th>Number of Award</th>
                  <td>16</td>
                </tr>
                <tr>
                  <th>Average Sales per month</th>
                  <td>$1,664,565</td>
                </tr>
                <tr>
                  <th>Team Ranking</th>
                  <td>1</td>
                </tr>
              </table>
              <hr>
              <strong>級別段數</strong>
                <ul class="nav flex-column">
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      Projects <span class="float-right badge bg-primary">31</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      Tasks <span class="float-right badge bg-info">5</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      Completed Projects <span class="float-right badge bg-success">12</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      Followers <span class="float-right badge bg-danger">842</span>
                    </a>
                  </li>
                </ul>


            </div>
          </div>
        </div>
        <div class="card card-success">
          <div class="card-header">
            <h4 class="card-title w-100">
              <a class="d-block w-100" data-toggle="collapse" href="#collapseThree">
                Notice
              </a>
            </h4>
          </div>
          <div id="collapseThree" class="collapse" data-parent="#accordion">
            <div class="card-body">
              <ul>
                <li>Notice 1</li>
                <li>Notice 2</li>
                <li>Notice 3</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
  </div>  
</div>

<div class="row">
  <div class="col-md-6 col-12">
    <?php $this->load->view('card_footer')?>
  </div>
</div>