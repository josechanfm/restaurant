<h1>Vue</h1>
<div id="main">
	<h1>{{message}}</h1>
	<ul>
		<li v-for="member in members">
			{{member.name_c}}{{member.name_e}}
		</li>
	</ul>
	<table class="table table-hover product-table">
	<thead>
	  <tr>
	    <th>Name</th>
	    <th>Description</th>
	    <th>Price</th>
	  </tr>
	</thead>
	<tbody>
	  <tr v-for="product in products" track-by="id">
	    <td>{{product.name}}</td>
	    <td>{{product.origin}}</td>
	    <td>{{product.volume}}:-</td>
	  </tr>
	</tbody>
	</table>

</div>

<script>
	$(document).ready(function() {
		//app.products=<?=json_encode($products)?>;
		//app.members=<?=json_encode($members)?>;
	});

</script>
