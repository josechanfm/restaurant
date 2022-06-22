
<el-row>
	<el-col :span="12">
		<el-tabs type="border-card" class="welcome_message">
			<el-tab-pane v-for="(fLang, langCode) in formLang" :label="fLang.name" v-if="$data['pane'][langCode]" >
				
				<el-form-item label="Form Title" label-width="auto">
		    		<el-input :name="'formTitle_'+langCode" label="Form Title" v-model="$data['formTitle'][langCode]"></el-input>
		    	</el-form-item>
		    	<el-form-item label-width="auto">
					<label>Welcome Message</label>
					<el-input :id="'welcome_'+langCode"  ></el-input>
				</el-form-item>
			</el-tab-pane>
		</el-tabs>
	</el-col>
	<el-col :span="12">
		<el-tabs type="border-card" class="success_message">
			<el-tab-pane v-for="(fLang, langCode) in formLang" :label="fLang.name" v-if="$data['pane'][langCode]" >

				<el-form-item label="Success Title" label-width="auto">
		    		<el-input :name="'successTitle_'+langCode" label="Form Title" v-model="$data['successTitle'][langCode]"></el-input>
		    	</el-form-item>
		    	<el-form-item label-width="auto">
					<label>Success Message</label>
					<el-input :id="'success_'+langCode"  ></el-input>
				</el-form-item>
			</el-tab-pane>
		</el-tabs>
	</el-col>
</el-row>