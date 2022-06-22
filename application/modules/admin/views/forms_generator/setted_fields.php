<!--setted fields item list -->					
<div class="callout" style="background-color: #fff !important;border-color: #007bff;">
	<h4><label >Created fields</label></h4>
	<table class="table setted_table" id="fields_list" @click="handleClick">
		<thead>
			<tr>
				<th v-for="(fLang, code) in formLang" v-if="fLang.selected">{{fLang.name}}</th>
				<th width="100px">Operation</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>
</div>