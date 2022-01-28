<?php $this->load->view('card_header')?>
<div class="row">
<div class="col-md-4">
<div class="panel-group" id="accordion">
  <div class="panel panel-default">
    <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapse1">
      <h4 class="panel-title">
        比賽成績
      </h4>
    </div>
    <div id="collapse1" class="panel-collapse collapse in">
      <div class="panel-body">
        <ul class="nav nav-stacked">
          <li><a href="#">澳門青少年賽 (1999-01-01)<span class="pull-right badge bg-blue">1</span></a></li>
          <li><a href="#">全澳公開賽 (2000-10-10)<span class="pull-right badge bg-aqua">3</span></a></li>
          <li><a href="#">粵港澳三角賽 (2010-11-11)<span class="pull-right badge bg-green">5</span></a></li>
        </ul>              
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapse2">
      <h4 class="panel-title">
        體能 / 級別
      </h4>
    </div>
    <div id="collapse2" class="panel-collapse collapse">
      <div class="panel-body">
        <table width="100%">
          <tr>
            <th>重量</th>
            <td>68 Kg</td>
          </tr>
          <tr>
            <th>身高</th>
            <td>169 CM</td>
          </tr>
          <tr>
            <th>肩寬</th>
            <td>52 CM</td>
          </tr>
          <tr>
            <th>胸寛</th>
            <td>52 CM</td>
          </tr>
        </table>
        <hr>
        <strong>級別段數</strong>
        <ul class="nav nav-stacked">
          <li><a href="#">綠帶<span class="pull-right badge bg-blue">2005-01-01</span></a></li>
          <li><a href="#">啡帶<span class="pull-right badge bg-aqua">2010-01-01</span></a></li>
          <li><a href="#">黑帶一段<span class="pull-right badge bg-green">2019-01-01</span></a></li>
        </ul>              
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" data-toggle="collapse" data-parent="#accordion" href="#collapse3">
      <h4 class="panel-title">
        Collapsible Group 3
      </h4>
    </div>
    <div id="collapse3" class="panel-collapse collapse">
      <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
      sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
      minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
      commodo consequat.</div>
    </div>
  </div>
</div>  
</div>
</div>
<?php $this->load->view('card_footer')?>
