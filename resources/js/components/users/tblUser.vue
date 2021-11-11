<template>
<div>
  <div class="row">
      <div class="col-lg-4">
          <input type="text"  v-model="key" class="form-control" placeholder="Ingrese acronimo">
      </div>
      <div class="col-lg-4">
          <button class="btn btn-primary btn-xs" @click="getAcronime">Consultar <i class="mdi mdi-account-search"></i></button>
      </div>
   </div>   
   <br>
   <div class="row">
      
    <div class="col-lg-12">
      <div class="table-responsive">
        <table          
          class="table table-striped table-bordered"
          style="width: 100%"
        >
          <thead>
            <tr class="bg-secondary">
              <th>#</th>
              <th>Abreviation</th>              
              <th>freq</th>
              <th>since</th>
              <th>vars</th>              
            </tr>
          </thead>
          <tbody>
              <tr v-for="(v,i) in users" :key="i">                
                  <th>{{ v.id }}</th>
                  <td>{{ v.sf }}</td>                  
                  <td>{{ v.freq }}</td>
                  <td>{{ v.since }}</td>
                  <td>
                    <i data-toggle="modal" data-target="#mdl_showinfo"  class="mdi mdi-account-search text-primary" @click="showVars(v)"></i>
                  </td>                  
              </tr>
          </tbody>
        </table>
      </div>
    </div>

<div class="modal fade" id="mdl_showinfo" tabindex="-1" role="dialog" aria-labelledby="mdl_showinfo" aria-hidden="true">
  <div class="modal-dialog modal-xs" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title text-center d-block" >INFO</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-striped ">
                    <thead>
                        <tr class="text-center">
                            <th>lf</th>
                            <th>freq</th>
                            <th>since</th>                            
                        </tr>
                    </thead>
                    <tbody>
                        <tr  class="text-center" v-for="(e,i) in vars" :key="i">
                            <td>{{ e.lf }}</td>
                            <td>{{ e.freq }}</td>
                            <td>{{ e.since }}</td>                            
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
      </div>      
    </div>
  </div>
  </div>

</div>
  </div>
</template>
<script>
export default { 
  title: "vision | acronimos" ,
  data: () => ({
    users: [], 
    vars:[],
    key:""   
  }),  
  methods: {
  
     getAcronime() {

       
       this.$http
        .get("/Acronime/searchingAcronime/"+this.key)
        .then((res) => {
          let d = res.data;
          console.log(res);
          this.users = d;
        });
    },
    showVars(v){
      this.vars=JSON.parse(v.vars);
    }  
  },
};
</script>
<style scoped>
.fz {
font-size: 22px !important;
}
</style>
