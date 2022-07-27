<template>
  <div id="customer">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Brands</h4>
            <div class="card-tools" style="position: absolute;right: 1rem;top: .5rem;">
              <button type="button" class="btn btn-info mr-3" @click="addItem">
                <i class="fas fa-plus"></i>
              </button>
              <button type="button" class="btn btn-primary" @click="reload">
                <i class="fas fa-sync"></i>
              </button>
            </div>
          </div>

          <div class="card-body">
            <!--  Search Field  -->

            <div class="table-responsive">
              <table class="table table-hover table-bordered table-striped">
                <thead>
                  <tr>
                    <th scope="col" class="text-center">SL</th>
                    <th scope="col" class="text-center">Brand Name</th>
                    <th scope="col" class="text-center">Status</th>
                    <th scope="col" class="text-center">Created By</th>
                    <th scope="col" class="text-center">Created At</th>
                    <th scope="col" class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-show="!tableData.length"><td class="text-center text-danger" colspan="6">No Data Found</td></tr>
                  <tr v-show="tableData.length" v-for="(brand, i) in tableData" :key="i">
                    <td class="text-center">{{ i+1 }}</td>
                    <td class="text-left">{{ brand.name }}</td>
                    <td class="text-center">{{ brand.status === '1' ? 'Active' : 'In Active' }}</td>
                    <td class="text-center">{{ brand.created_by.name }}</td>
                    <td class="text-center">{{ brand.created_at }}</td>
                    <td class="text-center">
                      <button type="button" class="btn btn-primary btn-sm mr-2" @click="editItem(brand)"><i class="fa fa-edit"></i></button>
                      <button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash-alt"></i></button>
                    </td>
                  </tr>
                </tbody>
              </table>
              <br>
              <pagination v-if="pagination.last_page > 1" :pagination="pagination" :offset="5" 
                @paginate="query === '' ? getData() : searchData() "
                 />
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal -->
    <div v-if="modalShow" class="modal fade show" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" 
    style="display: block;" aria-modal="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalScrollableTitle">{{ modalTitle }}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="modalShow=false">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <form>
                <div class="form-group">
                    <label for="name">Brand Name</label>
                    <input type="text" v-model="form.name" id="name" class="form-control" :class="errors.name ? 'is-invalid' : ''">
                    <small v-if="errors.name" class="text-danger">{{errors.name[0]}}</small>
                </div>
            </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal"  @click="modalShow=false">Close</button>
              <button type="button" class="btn btn-primary" @click="editMode === true ? update() : save()">{{ editMode === true ? 'Edit' : 'Save' }}</button>
            </div>
          </div>
        </div>
      </div>
    <!-- Modal -->

  </div>
</template>

<script>
import Pagination from '../Components/PaginationComponent.vue';
export default {
    name:'Brand',
    components:{
      Pagination
    },
    data(){
      return {
        modalTitle:"",
        editMode:false,
        modalShow:false,
        tableData:[],
        query:'',
        form:{
          name:'',
        },
        pagination: {
          current_page: 1
        },
        errors:{}
      }
    },
    created() {
      this.getData();
    },
    methods: {
      getData()
      {
        axios
        .get("brands?page=" + this.pagination.current_page)
        .then(res => {
          console.log(res);
            this.tableData = res.data.data;
            this.pagination = res.data.meta;
          
        })
        .catch(e => {
          console.log(e);
        });
      },
      searchData(){

      },
      reload(){

      },
      addItem()
      {
        this.modalTitle = "Add New Brand";
        this.modalShow = true;
        this. errors={};
      },
      editItem(item)
      {
          this.editMode = true;
          this.form = item;
          this.modalTitle = `Edit ${item.name} Data`;
          this.modalShow = true;
          this. errors={};
      },
      save()
      {
        axios
        .post("brands",this.form)
        .then(res => {
            Toast.fire({
                        icon: res.data.status === true ? 'success' : 'error',
                        title:res.data.message
                    });
            if(res.data.status === true)
            {
              this.getData();
              this.modalShow = false;
            }
        })
        .catch(error => {
          this.errors = error.response.data.errors;
        });
      },
      update()
      {
          
      },
      deleteConfirm(item)
      {

      },
      destroy(id)
      {

      }

    }
    
    
}
</script>

<style>

</style>