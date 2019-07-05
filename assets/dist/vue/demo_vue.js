var app=new Vue({
	el:"#main",
	data:{
		message:"Hello world!",
		products:[],
		members:[]
	},
	created(){
		axios.get("demos/vue/get_all_products")
		.then(response=>{
			this.products=response.data
		})
	},
	mounted: function(){
		this.message="hihihi";
		//console.log(this.message);
	},
	methods:{
	},
	watch:{
	}
});



