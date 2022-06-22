<div class="container" id="main">
  <div class="card card-warning shadow"> 
    <el-table
      :data="events"
      style="width: 100%"
      :default-sort="{prop:'apply_start',order:'descending'}">
      <el-table-column
        prop="id"
        label="Id">
      </el-table-column>
      <el-table-column
        prop="name"
        label="Name">
      </el-table-column>
      </el-table-column>
      <el-table-column
        label="Action">
        <template slot-scope="scope">
          <a :href="'./event/forms/'+scope.row.id"><el-button size="mini">Apply</el-button></a>
        </template>
      </el-table-column>
    </el-table>
  </div>
</div>

<script>
var app = new Vue({
  el: "#main",
  data: {
    events:[],

  },
  created() {
    this.getEvents();
  },
  methods: {
     async getEvents() {
      await axios.get('./event/ajax_get_events')
        .then(response => {
            this.events = response.data;
        })

    },
  },
})
</script>