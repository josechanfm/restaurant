<script src="../../assets/grocery_crud/texteditor/ckeditor/ckeditor.js"></script>


<div id="main">

	<el-form ref="form" :model="fields" label-width="120px" v-loading="loading">
		
		<input type="text" name="id" value="<?=$id?>" hidden>
		<input type="text" name="ctrl_path" value="<?=$ctrl_path?>" hidden>

		<div class="callout" style="background-color: #fff !important;border-color: #007bff;padding:0px;">
			<el-form-item label="Language" >
			    <el-checkbox v-for="(fLang, code) in formLang" :label="fLang.name" v-model="fLang.selected" @change="formLangChange(fLang,code)">{{fLang.name}}</el-checkbox>
			</el-form-item>
		</div>

		<!--Form General content, title and description-->
		<?php $this->load->view("message_box")?>
	  	<!-- Welcome Message Box -->
	  	<br>

		<?php $this->load->view("setted_fields");?>

		<?php $this->load->view("field_box");?>
		
		<button type="button" id="form_preview" class="btn btn-primary" @click="formPreview()" >Fill Now</button>
		<button type="button" @click="formSave" id="form_save" class="btn btn-success">Save</button>
		<a id="form_close" class="btn btn-default" href="event/board">Close</a>
		
	</el-form>
</div>
<br>

<style>
.field_operator .btn{
	padding: 6px 12px;
	color:white !important;
}
.field_operator .mandatory{
	border-radius: 0.5em;
    color: red !important;
    pointer-events: none;
    border: none;
    background-color: #fff;
}
.required{
	margin-left: 10px;
	color:red;
}
#fields_list td, #fields_list th{
	border-bottom: 1px solid darkgray;
}
.field_operator{
	text-align: right;
}

.welcome_message .el-tabs__header{
	background-color: #E6A23C !important;

}
.success_message .el-tabs__header{
	background-color: #67C23A !important;
}
.el-tabs__item{
	color:#fff !important;
	border-radius: 5px 5px 0 0;
	margin: 7px 0 0 5px !important;
}
.is-active{
	color:#000 !important;
}
</style>


