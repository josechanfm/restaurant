<!-- Upload Field -->
<el-col :span="24"  v-if="newField.field_type=='upload'">
	<div  id="additional_upload" class="form-group additional_config">
		<label for="additional" class="col-sm-2 control-label">Multiple files</label>
		<div class="col-sm-10">
			<input type="checkbox" v-model="newField['option_format']" value="multiple">
		</div>
	</div>
</el-col>

		

<!-- Date Field -->
<div class="col-md-12" v-if="newField.field_type=='date'">
	<div class="form-group additional_config">
		<label for="additional" class="col-sm-2 control-label">Date Format</label>
		<div class="col-sm-3 col-md-2">
			<select id="additional_date" name="date_format" v-model="newField['option_format']" class="form-control">
				<option value="yyyy-mm-dd">YYYY-MM-DD</option>
				<option value="yyyy-mm">YYYY-MM</option>
				<option value="yyyy">YYYY</option>
			</select>
		</div>
	</div>
</div>