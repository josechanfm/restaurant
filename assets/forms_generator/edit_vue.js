
var app=new Vue({

	el:"#main",
	data:{
		edit:true,
		id:0,
		ctrl_path:"",
		formTitle:[],
		successTitle:[],
		formData:[],
		//fl:{zh:{"name":"Chinese","value":true}},
		formLang:{
			zh:{name:"Chinese",selected:false},
			pt:{name:"Portuguese",selected:false},
			en:{name:"English",selected:false}
		},
		pane:{
			zh:true,
			pt:false,
			en:false,
		},
		content: null ,
		fields:[],
		form_uploads:[],
		fieldOptions:[],
		
		//init new field box
		newField:{
			field_type:"text",
			rule:[],
			mandatory:true,
			default_option:"",
		},
		
		//---field type
		fieldTypes:{
			text:{name:"Text Box",extra:0},
			dropdown:{name:"Dropdown",extra:1},
			radio:{name:"Radio",extra:1},
			checkbox:{name:"Checkbox",extra:1},
			textarea:{name:"Textarea",extra:0},
			date:{name:"Date",extra:0},
			upload:{name:"Upload",extra:0},
			// upload:{name:"File Upload",extra:0},
			// student_num:{name:"Student",extra:0},
			// macao_phone:{name:"Macao Cell Phone",extra:0},
			// seperator:{name:"Seperator",extra:2}
		},
		editFieldItem:"",

		rules:[
			{ value:"number",label:"Only Number" },
			{ value:"email",label:"Email" },
			{ value:"birm",label:"Macau ID" },
		],
		loading:false,
	},
	created(){
		id = $("input[name=id]").val()
		this.ctrl_path = $("input[name=ctrl_path]").val()
		this.init(id)
	},
	mounted: function(){
	},
	methods:{
		init(id){
			this.id=id;
			axios.get(this.ctrl_path+'/get_form/'+this.id)
			.then(response=>{
				console.log(response.data)
				this.formData=response.data;
				//this.formData.login=this.formData.login==1?true:false;
				this.formData.fields=$.parseJSON(this.formData.fields);
				this.formData.lang=$.parseJSON(this.formData.lang);
				this.formData.uploads=$.parseJSON(this.formData.uploads);
				
				this.formTitle=$.parseJSON(this.formData.title);
				this.successTitle=$.parseJSON(this.formData.success_title);
				
				this.refreshFields();

				this.formData.uploads.map(function(upload){
					if( $.inArray( this.uploadDocuments,upload ) == -1 ){
						// console.log(upload)	
					}
					// this.uploadDocuments[upload]=upload
				})
			})
		},
		formSave(){
			app.loading = true

			uploads = []
			$(".uploadDocuments:checkbox:checked").each(function(i,element){
				//save upload field 防止重覆
				uploads.push(element.name)
				app.formData.uploads = uploads
			})

			//form title and welcome message
			this.updataWelcomeMessage()
			this.setFormTitle()

			this.updataSuccessMessage()
			this.setSuccessTitle()

			data = Object.assign({}, this.formData)

			data.fields = JSON.stringify(data.fields)
			data.uploads = JSON.stringify(data.uploads)
			data.lang = JSON.stringify(data.lang)
			data.welcome = JSON.stringify(data.welcome)
			data.title = JSON.stringify(data.title)
			data.success_title = JSON.stringify(data.success_title)
			data.success = JSON.stringify(data.success)

			console.log(data.success_title)

			axios.post(this.ctrl_path+"/form_save/", 
				data
			)
			.then(response=>{

				app.refreshFields()

				this.$message({
                    type: 'success',
                    message: 'Saved.'
                });
                setTimeout( function(){
                	app.loading = false
                } , 500);
			})
		},
		refreshFields(){

			$.each(this.formData.lang,function(idx,code){
			 	app.formLang[code].selected=true;
			});
			$("#fields_list tbody").empty();

			$.each(this.formData.fields, function(idx, field){
				
				app.formData.lang.map(function(lang) {
				   //Find which field of lang is not exist
				   if(field["name_"+lang] === undefined ){
				   	field["name_"+lang] = "";
				   }
				});

				tr = app['new_'+field.field_type](field)
				
				$("#fields_list tbody").append(tr);
				
				//---Operation Bar	
				$("#fields_list tbody tr:last").append(app['new_operation'](field,idx));
				//$("#fields_list tbody").append("<tr><td colspan='"+(app.formData.lang.length+1)+"'><hr style='border-color:darkgray;margin:0px'></td></tr>");
			});

			$.each(this.formData.uploads, function(idx,upload){
				$(".uploadDocuments:checkbox[name='"+upload+"']").prop("checked",true);
			})

			this.setWelcomeEditor()
			this.setSuccessEditor()
		},

		updataWelcomeMessage(){
		
			array = {}
			$.each( this.formData.lang ,function(index,value){
				message = CKEDITOR.instances['welcome_'+value].getData()
				array[value] = message 
			})
			this.formData.welcome = array
		},
		updataSuccessMessage(){
		
			array = {}
			$.each( this.formData.lang ,function(index,value){
				message = CKEDITOR.instances['success_'+value].getData()
				array[value] = message 
			})
			this.formData.success = array
		},

		new_text(field){
			tr=$("<tr/>");
			$.each(app.formData.lang,function(i,l){
				td=$("<td class='lang_"+l+"'>");
				td.append("<label>"+field['name_'+l]+"</label><input type='text' class='form-control'>");
				tr.append(td);
			})
			return tr;
		},
		new_dropdown(field){
			tr=$("<tr/>");
			$.each(app.formData.lang,function(i,l){
				td=$("<td class='lang_"+l+"'>");
				td.append($("<label/>").html(field['name_'+l]));
				sel=$("<select class='form-control'><select/>");
				$.each(field['options'],function(i,s){
					sel.append($("<option/>").html(s[l]));
				})
				if(field["default_option"]!=''){
					defaultOption=sel.find("option").eq(field['default_option']);
					defaultOption.prop({"selected":true});
					defaultOption.text("*"+defaultOption.text());
				}
				td.append(sel);
				tr.append(tr.append(td));
			})
			return tr;
		},
		new_radio(field){
			tr=$("<tr/>");
			$.each(app.formData.lang,function(i,l){
				td=$("<td class='lang_"+l+"'>");
				td.append($("<label/>").html(field['name_'+l]));
				td.append("<br>");
				$.each(field['options'],function(j,s){
					item=$("<div class='radio_item'/>");

					item.append($("<input type='radio' name='set_field_"+l+"_"+i+"'/>"));
					item.append("&nbsp;&nbsp;<radio_option>"+s[l]+"</radio_option");
					td.append(item);
				})
				if(field["default_option"]!=""){
					defaultOption=td.find(".radio_item").eq(field['default_option']);
					defaultOption.find("input").prop({"checked":true});
					defaultOption.find("radio_option").text("*"+defaultOption.find("radio_option").text());
				}
				tr.append(td);
			})
			return tr;

		},
		new_checkbox(field){
			tr=$("<tr/>");
			$.each(app.formData.lang,function(i,l){
				td=$("<td class='lang_"+l+"'>");
				td.append($("<label/>").html(field['name_'+l]));
				td.append("<br>");
				$.each(field['options'],function(j,s){
					item=$("<div class='checkbox_item'/>");
					item.append($("<input type='checkbox' name='set_field_"+l+"_"+i+"'/>"));
					item.append("&nbsp;&nbsp;<checkbox_option>"+s[l]+"</checkbox_option");
					td.append(item);
				})
				if(field["default_option"]!=""){
					defaultOption=td.find(".checkbox_item").eq(field['default_option']);
					//defaultOption.find("input").prop({"selected":true});
					defaultOption.find("checkbox_option").text("*"+defaultOption.find("checkbox_option").text());
				}
				tr.append(td);
			})
			return tr;

		},
		new_textarea(field){
			tr=$("<tr/>");
			$.each(app.formData.lang,function(i,l){
				td=$("<td class='lang_"+l+"'>");
				td.append("<label>"+field['name_'+l]+"</label><textarea class='form-control'/>");
				tr.append(td);
			})
			return tr;
		},
		new_email(field){
			tr=$("<tr/>");
			$.each(app.formData.lang,function(i,l){
				td=$("<td class='lang_"+l+"'>");
				td.append("<label>"+field['name_'+l]+"</label><input type='email' class='form-control'>");
				tr.append(td);
			})
			return tr;
		},
		new_date(field){
			tr=$("<tr/>");
			$.each(app.formData.lang,function(i,l){
				td=$("<td class='lang_"+l+"'>");
				td.append("<label>"+field['name_'+l]+"</label><input type='text' placeholder='"+field['option_format']+"' class='form-control input_date'>");
				tr.append(td);
			})
			return tr;
		},
		new_upload(field){
			tr=$("<tr/>");
			$.each(app.formData.lang,function(i,l){
				td=$("<td class='lang_"+l+"'>");
				td.append("<label>"+field['name_'+l] +"</label>" + (field['option_format']?"&nbsp;&nbsp;(Multiple)":""));
				td.append("<input type='file' class='form-control'>");
				tr.append(td);
			})
			return tr;
		},
		new_number(field){
			tr=$("<tr/>");
			$.each(app.formData.lang,function(i,l){
				td=$("<td class='lang_"+l+"'>");
				td.append("<label>"+field['name_'+l]+"</label><input type='number' class='form-control'>");
				tr.append(td);
			})
			return tr;
		},
		new_student_num(field){
			tr=$("<tr/>");
			$.each(app.formData.lang,function(i,l){
				td=$("<td class='lang_"+l+"'>");
				td.append("<label>"+field['name_'+l]+"</label><span>&nbsp;&nbsp;(P21-1234-5)</span><input type='text' pattern='P[0-9]{2}-[0-9]{6}-[0-9]{-}' class='form-control'>");
				tr.append(td);
			})
			return tr;
		},
		new_macao_phone(field){
			tr=$("<tr/>");
			$.each(app.formData.lang,function(i,l){
				td=$("<td class='lang_"+l+"'>");
				td.append("<label>"+field['name_'+l]+"</label><input type='number' min='60000000' max='69999999' class='form-control'>");
				tr.append(td);
			})
			return tr;
		},
		new_seperator(field){
			tr=$("<tr/>");
			$.each(app.formData.lang,function(i,l){
				td=$("<td class='lang_"+l+"'>");
				td.append("<label>"+field['name_'+l]+"</label><br>"+field['options'][0][l]);
				tr.append(td);
			})
			return tr;
		},
		new_operation(field,idx){
			str="<td class='field_operator ' width='20%' data-key='"+idx+"'>";
			str+=field["mandatory"]?"<a class='btn btn-default mandatory pull-left'><i class='fa fa-asterisk'></i></a>":"";
			str+="<a class='field_trash btn btn-danger pull-left'><i class='fa fa-trash'></i></a>";
			str+="<a class='field_edit btn btn-info pull-left' ><i class='fa fa-edit'></i></a>";
			if(field["mandatory"]=='true'){
				//str+="<i class='required fa fa-certificate'></i>";	
				str+="<span class='required'>Mandate</span>";	
			}
			str+="</td>"
			return str;
		},
		btnAddField(){
			this.newField.options=this.fieldOptions;
			this.formData.fields.push(this.newField);
			this.resetFieldPanel();
			this.refreshFields();
		},
		btnUpdateField(){
			this.newField.options=this.fieldOptions;
			this.formData.fields[this.editFieldItem]=this.newField;
			this.resetFieldPanel();
			this.refreshFields();
			console.log("update field");
		},
		btnClearField(){
			console.log("clear Field");
			this.resetFieldPanel();
		},
		resetFieldPanel(){
			this.newField={field_type:"text",default_option:""};
			this.fieldOptions=[];
			this.editFieldItem="";
		},
		fieldTypeChange(event){
			if(this.fieldOptions.length<=0){
				this.addFieldOption();
			}
		},
		setFormTitle(){
			title = Object.assign({}, this.formTitle )
			this.formData.title = title
		},
		setSuccessTitle(){
			success = Object.assign({}, this.successTitle )
			this.formData.success_title = success
		},

		addFieldOption(){
			options={};
			$.each(this.formLang, function(key, item){
				options[key]="";
			});
			this.fieldOptions.push(options);
		},
		addUpload(){
			//set the upload field array 
			this.$set(this.uploadDocuments,this.add_upload, this.add_upload)
			this.formData.uploads.push(this.add_upload)
			this.add_upload = ""
		},
		
		formPreview(){
			window.open("../../event/apply/"+app.id, '_blank');
		},
		handleClick(e){
			if(e.target.matches('.field_trash')){
				idx=$(e.target).parent().data("key");
				this.formData.fields.splice(idx,1);
				this.refreshFields();
			}
			if(e.target.matches('.field_trash i')){
				idx=$(e.target).parent().parent().data("key");
				this.formData.fields.splice(idx,1);
				this.refreshFields();
			}
			if(e.target.matches('.field_edit')){
				idx=$(e.target).parent().data("key");
				this.editSelectedField(this.formData.fields[idx],idx);
			}
			if(e.target.matches('.field_edit i')){
				idx=$(e.target).parent().parent().data("key");
				this.editSelectedField(this.formData.fields[idx],idx);
			}
		},
		editSelectedField(field,idx){
			this.editFieldItem=idx;
			this.newField=field;
			this.fieldOptions=field.options;
		},
		formLangChange(fLang,code){
			console.log("lang Change");

			if(fLang.selected == false){

				app.formData.lang.splice(app.formData.lang.indexOf(code),1)
			}else{
				app.formData.lang.push(code)
				
				// CKEDITOR.replace( 'welcome_'+code );
			}

			//eg:['zh','pt','en']
			lang_sequence = Object.keys(app.formLang)
			list = [] 
			//重新排序
			//將app.formData.lang排成一開始的序列
			//Sort the formData lang as well as initial sequence
			lang_sequence.map(function(lang,key){
				app.formData.lang.includes(lang)?list.push(lang):''
			})
			app.formData.lang = list

			this.setWelcomeEditor()
			this.setSuccessEditor()
		},
		setWelcomeEditor(){
			setTimeout( () => {
				welcome = $.parseJSON(app.formData.welcome)
				
				$.each(app.formData.lang,function(index,value){
					//Set Editior, if editior exist
					if( $("#welcome_"+value).length == 1 && !(CKEDITOR.instances['welcome_'+value]) ){
						CKEDITOR.replace('welcome_'+value);
						edt = CKEDITOR.instances['welcome_'+value]
						if(welcome == null){
							edt.setData("")	
						}else{
							edt.setData(welcome[value]);
						}
					}
				})
            }, 100);
		},
		setSuccessEditor(){
			setTimeout( () => {
				success = $.parseJSON(app.formData.success)
				
				$.each(app.formData.lang,function(index,value){
					//Set Editior, if editior exist
					if( $("#success_"+value).length == 1 && !(CKEDITOR.instances['success_'+value]) ){
						CKEDITOR.replace('success_'+value);
						edt = CKEDITOR.instances['success_'+value]
						if(success == null){
							edt.setData("")	
						}else{
							edt.setData(success[value]);
						}
					}
				})
            }, 100);
		},
		doSomething(){
			this.alertMessage="Something was done!";
		}
	},
	watch:{
		alertMessage(){
			alert(this.alertMessage);
		},
		'formData.lang':(lang)=>{
			//Control the language pane 
			$.each(app.pane, function(key,value){
				
				if( $.inArray(key,lang) != -1 ){
					app.pane[key] = true
				}else{
					console.log("Clear editor")
					// clear the editor instance
					if( CKEDITOR.instances['welcome_'+key] ){
						//check the instances exist
						CKEDITOR.instances['welcome_'+key].destroy()	
					}

					// clear the editor instance
					if( CKEDITOR.instances['success_'+key] ){
						//check the instances exist
						CKEDITOR.instances['success_'+key].destroy()	
					}
					app.pane[key] = false
					
				}

			})
		}

	},
	computed:{
		somethingDone:function(){
			return this.alertMessage;
		}
	},

});



