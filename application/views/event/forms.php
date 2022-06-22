<?php //$this->lang->load('forms',$available_languages[$language]['value']);
?>
<?php //$this->load->view('forms/generals/form_header');?>
<div class="container">
	<?=$language?>
<input type="hidden" name="form_id" value="<?=$data->id?>">
<input id="language" value="<?=$language?>" hidden>

<div id="main">
<el-skeleton :loading="skeleton" animated>
	
	<!-- Check form language exist -->
	<div v-if="form_lang.includes( '<?=$language?>' ) && fill_form" >
		<div class="callout callout-info">
			<h1>{{form_title[language]}}</h1>
			<hr>
			<h3 v-html="form_welcome[language]"></h3>
		</div>
		<!-- 表格有對應的語言 -->
		<el-card class="box-card" shadow="always">
			<el-form :model="form_data" ref="form_data" :rules="rules">
				
				<el-row v-for="(field,key) in form_fields">
	                <el-form-item :label="<?='field.name_'.$language?>" :prop="'field_'+key" >
	                    <!-- Text -->
	                    <el-input v-if="field.field_type=='text'" v-model="$data['form_data']['field_'+key]"></el-input>
	              
	                    <!-- Date -->
	                    <el-date-picker v-if="field.field_type=='date'" v-model="$data['form_data']['field_'+key]"></el-date-picker>

	                    <!-- Radio -->
	                    <el-radio v-if="field.field_type=='radio'" v-for="(option,value) in field.options" v-model="$data['form_data']['field_'+key]" :label="value">{{option.zh}}</el-radio>

	                    <!-- Dropdown -->
	                    <el-select v-if="field.field_type=='dropdown'"  v-model="$data['form_data']['field_'+key]" >
		                    <el-option v-for="(option,value) in field.options" :label="option.zh" :value="value"></el-option>
		                </el-select>

	                    <!-- Checkbox -->
		                <el-checkbox-group v-if="field.field_type=='checkbox'"  v-model="$data['form_data']['field_'+key]">
					    	<el-checkbox v-for="(option,value) in field.options" :label="option.zh" name="field_4"></el-checkbox>
					    </el-checkbox-group>

					    <el-input v-if="field.field_type=='textarea'" type="textarea" v-model="$data['form_data']['field_'+key]"></el-input>

					    <el-upload  
					     	v-if="field.field_type=='upload'&&field.option_format!=true"
				        	limit="1"
				        	:action="'./event/upload_field_key/'+key"
				        	class="upload-demo"
				        	:on-success="setFileUpload" 
				        	>
							<el-button size="small" type="primary">Click to upload</el-button>
						</el-upload>

						<el-upload
						  v-if="field.field_type=='upload'&&field.option_format==true"
						  class="upload-demo"
						  drag
						  :action="'./event/upload_field_key/'+key"
						  multiple
				          :on-success="setFileUpload"
				          >
						  <i class="el-icon-upload"></i>
						  <div class="el-upload__text">Drop file here or <em>click to upload</em></div>
						</el-upload>

	                </el-form-item>

		        </el-row>

		        <el-row v-for="upload in form_uploads" >
		        	<el-col :span="6">
				        <el-form-item :label="upload" >
					        <el-upload 
					        	limit="1"
					        	action="./event/index"
					        	class="upload-demo"
					        	:on-success="setFileUpload">
								<el-button size="small" type="primary">Click to upload</el-button>
							</el-upload>
						</el-form-item>
					</el-col>
				</el-row>

			<el-form>

	        <div class="dialog-footer">
	        	<el-button type="primary" @click="formSubmit('form_data')">Submit</el-button>
	        </div>
	    </el-card>
	    <!-- language exist -->
	</div>
    <div v-if="!(form_lang.includes( '<?=$language?>' ) )">
    	<!-- 表格語言不對 -->
    	<div class="callout callout-warning">
	      <h4>注意 / Attention / Atenção!</h4>
	      <p>抱歉，這表格不提供您所選擇的語言！</p>
	      <p>Sorry, this form does not provide the language you selected!</p>
	      <p>Desculpe, este formulário não fornece o idioma que você selecionou!</p>
        </div>
    </div>
    <div v-if="fill_success">
    	<el-row>
		  <el-col>
		    <el-result icon="success" title="Success Tip">
		      <template slot="subTitle">
		      	<span v-html="form_success[language]"></span>
		      </template>
		      <template slot="extra">
		        <el-button @click="function(){history.go(-1);}" type="success" size="medium">Back</el-button>
		      </template>
		    </el-result>
		  </el-col>
		</el-row>
    </div>
</el-skeleton>
</div>

	 	
		
</div>

<style>
.required{
	margin-left:10px;
	color:red;
}
input[type="file"]{
	display:none;
}
</style>