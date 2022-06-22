var app = new Vue({
    el: "#main",
    data: {
        language:"",
        form_id:'',
        form_lang:[],
        form_fields:[],
        form_uploads:[],
        form_title:[],
        form_welcome:[],
    	form_success:[],
    	form_data:{},

        files:[],
    	rules:{},

        list:[],

        fill_form:true,
        fill_success:false,
        msg:"",
        skeleton:true,
    },

    created() {
        this.form_id = $("input[name=form_id]").val()
        this.language = $("#language").val()
        this.getEventForm();

    },

    methods: {
        setFileUpload(response, file, fileList){
            key = response
            this.$set(this.form_data,'field_'+key,file.name)

            this.files.push(file)
        },

        async getEventForm() {
            await axios.post('./event/ajax_get_event_form/',
                {'form_id':this.form_id}
                )
            .then(response => {
                console.log(response.data)
                this.form_fields = JSON.parse(response.data.fields);
                this.form_uploads = JSON.parse(response.data.uploads);
                this.form_lang = JSON.parse(response.data.lang);
                this.form_title = JSON.parse(response.data.title);
                this.form_welcome = JSON.parse(response.data.welcome);
                this.form_success = JSON.parse(response.data.success);
            
                this.form_fields.map(function(value,key){

                    if(value.field_type == "checkbox"){
                        // set the array in checkbox
                        // app.form_data['field_'+key]=[]
                        app.$set(app.form_data,['field_'+key],[])
                    }

                    app.addRule(value,key)
                })
            })
            this.skeleton = false
        },

        addRule(value,key){

            rule_group = []
            if(value.mandatory == true){
                // Push rule
                rule_group.push( { required: true, message: 'Required Field', trigger: 'change' } )
            }

            $.each(value.rule,function(num,rule){
                //Call function dynamically
                rule_group = app["rule_"+rule]( rule_group )
            })

            this.$set(app.rules,['field_'+key],rule_group)

        },

        rule_number(rule_group){
            rule_group.push( { type : "number", transform: Number, message: 'Please input number' } )
            return rule_group
        },
        rule_email(rule_group){
            rule_group.push( { type : "email", message: 'Please input correct email' } )
            return rule_group
        },
        rule_birm(rule_group){
            rule_group.push( { max : 8, message: 'Please input correct Birm', trigger: 'blur' } )
            rule_group.push( { min : 8, message: 'Please input correct Birm', trigger: 'blur' } )
            rule_group.push( { validator: (rule, value, callback) => {
                this.validateBIRM(rule, value, callback);
              }, trigger: 'blur' } )
            return rule_group
        },

        validateBIRM(rule, value, callback){
            axios.post('./api/ValidateId/check_birm',
               { 'birm':value }
            )
            .then(response => {
                console.log(response.data)
                if( !response.data ){
                    return callback("BIRM does not collect");    
                }
            })
        },

        async EventFormSubmit() {

            const formData = new FormData()

            //Add the upload files to formData
            $.each(this.files,function(key,value){
                formData.append(key, value.raw)
            })

            //Add the form id & field data
            formData.append('form_id', this.form_id )
            formData.append('fields', JSON.stringify( this.form_data ) )


            await axios.post('./event/ajax_submit_event_form',
                formData
            )
            .then(response => {
            	console.log(response.data)
                this.fill_form=false
                this.fill_success=true
            })
        },

        async formSubmit(formName) {
            this.$refs[formName].validate((valid) => {
                if (valid) {
                    this.$confirm('Confirm submit?', 'Tips', {
                        confirmButtonText: 'OK',
                        cancelButtonText: 'Cancel',
                        type: 'warning'
                    }).then(() => {
                        this.EventFormSubmit()
                        this.$message({
                            type: 'success',
                            message: 'Success!'
                        });
                    })
                } else {
                    console.log('error submit!!');
                    return false;
                }
            });
        },
    },
    watch:{
    },
    mounted: function(){
    }
})