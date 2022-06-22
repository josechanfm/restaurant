<div class="callout" style="background-color: #fff !important;border-color: #007bff;">
	<!-- Field Type-->
	<el-row>
		<el-col :span="8">
			<label>Field Type</label>
			<el-select v-model="newField.field_type" @change="fieldTypeChange($event)" style="width:70%">
			    <el-option
			      v-for="(item, key) in fieldTypes" :value="key" :label="item.name">
			    </el-option>
			</el-select>
		</el-col>
		<el-col :span="8">
			<label for="rule">Rule</label>
			<el-select v-model="newField.rule" multiple size="large" style="width:80%">
			    <el-option
			      v-for="rule in rules"
			      :key="rule.value"
			      :label="rule.label"
			      :value="rule.value">
			    </el-option>
			</el-select>
		</el-col>
		<el-col :span="3">
			<label for="rule">Mandatory</label>
			<el-checkbox v-model="newField.mandatory" value="1"></el-checkbox>
		</el-col>
	</el-row>
	<!-- Field Type-->
	<!-- <br>
	<el-row >
		<label>Quick Fill in</label>
		<el-button v-if="newField.field_type=='text'" round @click="setNewField('name_zh')">Chinese Name</el-button>
		<el-button v-if="newField.field_type=='text'" round @click="setNewField('name_en')">English Name</el-button>
		<el-button v-if="newField.field_type=='upload'" round @click="setNewField('photo')">Photo</el-button>
		<el-button v-if="newField.field_type=='upload'" round @click="setNewField('birm')">BIRM</el-button>
		<el-button v-if="newField.field_type=='upload'" round @click="setNewField('passport')">Passport</el-button>
	</el-row> -->
	<br>
	<!-- Name Field -->
	<el-row v-for="(fLang, code) in formLang" v-if="fLang.selected">
		<el-col :span="24" >
			<label class="col-sm-2 control-label">Name ({{code}})</label>
			<el-input v-model="newField['name_'+code]"></el-input>
		</el-col>
		<?php $this->load->view("field_additional");?>
	</el-row>
	<br>
	<el-row v-if="newField.field_type && fieldTypes[newField.field_type].extra==1">
	<div :span="24">
		<table class="table">
			<thead>
				<tr>
					<th v-for="(fLang, code) in formLang" v-if="fLang.selected">{{fLang.name}}</th>
					<th>Default
						<a id="no_option_default"><i class="fa fa-close" style="color:red"></i></a></th>
					<th>Operation</th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="(fieldOption, idx) in fieldOptions" v-if="fieldOptions.length>0">
					<td v-for="(fLang, code) in formLang" v-if="fLang.selected">
						<input type="text" class="form-control"  v-model="fieldOption[code]">
					</td>
					<td>
						<input type="radio" name="fieldOptionDefault" v-model="newField.default_option" :value="idx" v-bind:id="idx">
					</td>
					<td>
						<a class="trash_field" @click="deleteFieldOption(idx)"><i class="fa fa-trash"></i></a>
						<a class="add_field" @click="addFieldOption()"><i class="fa fa-plus"></i></a>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	</el-row>
	<!-- Name Field -->

	<div class="col-md-12" id="seperator_list" v-if="newField.field_type && fieldTypes[newField.field_type].extra==2">
		<div  v-for="(fLang, code) in formLang" v-if="fLang.selected">
			<label>{{fLang.name}}</label>
			<textarea v-model="fieldOptions[0][code]" class="form-control" rows="5"></textarea>
		</div>
	</div>

	<div class="text-center" style="display: block;">
		<button class="btn btn-primary" type="button" @click="btnAddField" v-if="editFieldItem==''">Add Field</button>
		<button class="btn btn-primary" type="button" @click="btnUpdateField" v-if="editFieldItem!=''">Update Field</button>
		<button class="btn btn-default" type="button" @click="btnClearField">Clear</button>
    </div>
</div>