<template>
  <div>

<div class="row">
    
<div class="col-lg-4">
          <strong>Nombre : <label class="text-danger">*</label> </strong>
          <input type="text" maxlength="50" class="form-control" v-model="fullname" placeholder="Ej : Alejandro Hernandez">
      </div>
        <div class="col-lg-3">
          <strong>Porcentaje :  <label class="text-danger">*</label></strong>
          <input type="number" class="form-control" v-model="per" placeholder="Ej : 90" >
      </div>
      <div class="col-lg-2">
        <button class="btn btn-success btn-xs" @click="search">Consultar &nbsp;<i class="mdi mdi-account-search fz"></i></button>          
      </div>

</div>
      <br>

      <div class="row">
      
    <div class="col-lg-12">
      <div class="table-responsive">
        <table
          id=""
          class="table table-striped table-bordered dt_search"
          style="width: 100%"
          v-if="task.length>0"
        >
          <thead>
            <tr class="bg-secondary">              
              <th>Nombre</th>
              <th>Tipo Persona</th>
              <th>Cargo</th>
              <th>Localidad</th>              
              <th>Municipio</th>                            
            </tr>
          </thead>
          <tbody>
              <tr v-for="(v,i) in task" :key="i">                                  
                  <td>{{ v.nombre }}</td>                
                   <td>{{ v.tipo_persona }}</td>                
                  <td>{{ v.tipo_cargo }}</td>                
                  <td>{{ v.departamento }}</td>                  
                  <td>{{ v.municipio }}</td>                                                   
              </tr>
          </tbody>
        </table>
      </div>
    </div>
</div>
</div>

</template>
<script>
export default {   
  title: "Buscador",
  data: () => ({
    task: [],    
    fullname:'',
    per:0
  }),
  
  methods: {
          

search(){

if(this.fullname!='' && this.per!=0){

sweetMessageTimeOut(
            "Procesando ...",
            "\u00A1  Su solicitud  se encuentra en ejecuci\u00F3n ! ",
            3000
    );
    this.$http
        .get("/searching/service/"+this.fullname+"/"+this.per)
        .then((res) => {
            
            if(res.status==201){                
                let d = res.data.data;                 
                this.task = d;
                if(this.task.length>0){

                    this.$nextTick(() => {
                        $(".dt_search").DataTable({
                            responsive: true,
                            orderable: true,
                            destroy: true,                        
                        });
                    });
                    sweetMessage(
                    "\u00A1Registro exitoso!",
                    "\u00A1 Se ha realizado con \u00E9xito su solicitud!"
                    );
                }else{
                    sweetMessage("ERROR!","No se encontraron registros", "error");
                }
            }
          
        });
}else{
    sweetMessage("ATENCION!","Por favor los campos obligatorios (*)", "error");
}
    
    },        
  },
};
</script>
<style scoped>
.fz {
font-size: 22px !important;
}
</style>
