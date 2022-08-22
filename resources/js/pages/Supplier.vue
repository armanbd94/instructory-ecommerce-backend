<template>
  <div id="customer">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Suppliers</h4>
            <div class="card-tools" style="position: absolute;right: 1rem;top: .5rem;">
              <button type="button" class="btn btn-primary mr-3" @click="addItem">
                <i class="fas fa-plus"></i>
              </button>
              
            </div>
          </div>
          <div class="card-header col-nd-12">
            <div class="row">
              <div class="form-group col-md-4">
                    <input type="text" v-model="query.name" id="name" class="form-control" placeholder="Search Supplier Name">
              </div>
              <div class="form-group col-md-4">
                    <input type="text" v-model="query.mobile_no" id="mobile_no" class="form-control" placeholder="Search Mobile No.">
              </div>
              <div class="form-group col-md-4 text-right">
                  <button type="button" class="btn btn-info mr-2" @click="searchData">
                    <i class="fas fa-search"></i>
                  </button>
                  <button type="button" class="btn btn-warning" @click="reload">
                    <i class="fas fa-sync"></i>
                  </button>
              </div>
            </div>
          </div>
          <div class="card-body">
            <!--  Search Field  -->

            <div class="table-responsive">
              <table class="table table-hover table-bordered table-striped">
                <thead>
                  <tr>
                    <th scope="col" class="text-center">SL</th>
                    <th scope="col" class="text-center">Supplier Name</th>
                    <th scope="col" class="text-center">Moile No.</th>
                    <th scope="col" class="text-center">Address</th>
                    <th scope="col" class="text-center">Status</th>
                    <th scope="col" class="text-center">Created By</th>
                    <th scope="col" class="text-center">Created At</th>
                    <th scope="col" class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-show="!tableData.length"><td class="text-center text-danger" colspan="8">No Data Found</td></tr>
                  <tr v-show="tableData.length" v-for="(item, i) in tableData" :key="i">
                    <td class="text-center">{{ i+1 }}</td>
                    <td class="text-left">{{ item.name }}</td>
                    <td class="text-left">{{ item.mobile_no }}</td>
                    <td class="text-left">{{ item.address }}</td>
                    <td class="text-center">{{ item.status === '1' ? 'Active' : 'In Active' }}</td>
                    <td class="text-center">{{ item.created_by.name }}</td>
                    <td class="text-center">{{ item.created_at }}</td>
                    <td class="text-center">
                      <button type="button" class="btn btn-primary btn-sm mr-2" @click="editItem(item)"><i class="fa fa-edit"></i></button>
                      <button type="button" class="btn btn-danger btn-sm" @click="deleteItem(item)"><i class="fa fa-trash-alt"></i></button>
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
                    <label for="name">Supplier Name</label>
                    <input type="text" v-model="form.name" id="name" class="form-control" :class="errors.name ? 'is-invalid' : ''">
                    <small v-if="errors.name" class="text-danger">{{errors.name[0]}}</small>
                </div>
                <div class="form-group">
                    <label for="mobile_no">Mobile No.</label>
                    <input type="text" v-model="form.mobile_no" id="mobile_no" class="form-control" :class="errors.mobile_no ? 'is-invalid' : ''">
                    <small v-if="errors.mobile_no" class="text-danger">{{errors.mobile_no[0]}}</small>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea v-model="form.address" id="address" class="form-control" :class="errors.address ? 'is-invalid' : ''"></textarea>
                    <small v-if="errors.address" class="text-danger">{{errors.address[0]}}</small>
                </div>
            </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal"  @click="modalShow=false">Close</button>
              <button type="button" class="btn btn-primary" @click="editMode === true ? update() : save()">{{ editMode === true ? 'Update' : 'Save' }}</button>
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
        query:{
          name:'',
          mobile_no:''
        },
        form:{},
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
        .get("suppliers?page=" + this.pagination.current_page)
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
        const query = $.param(this.query);
        axios
        .get("suppliers?page=" + this.pagination.current_page+"&"+query)
        .then(res => {
          console.log(res);
            this.tableData = res.data.data;
            this.pagination = res.data.meta;
          
        })
        .catch(e => {
          console.log(e);
        });
      },
      reload(){
        this.query.name = '';
        this.query.mobile_no = '';
        this.getData();
      },
      addItem()
      {
        this.modalTitle = "Add New Supplier";
        this.modalShow = true;
        this.editMode = false;
        this.form = {
          name:'',
          mobile_no:'',
          address:''
        };
        this.errors={};
      },
      editItem(item)
      {
          this.errors={};
          this.editMode = true;
          this.form = {
            id:item.id,
            name:item.name,
            mobile_no:item.mobile_no,
            address:item.address,
          };
          this.modalTitle = `Edit ${item.name} Data`;
          this.modalShow = true;
          
      },
      save()
      {
        axios
        .post("suppliers",this.form)
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
          axios
        .put("suppliers/"+this.form.id,this.form)
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
      deleteItem(item)
      {
        new Swal({
          title: `Are you sure to delete ${item.name} data?`,
          text:"You won't be able to revert this!",
          showCancelButton:true,
          confirmButtonColor:'#6777ef',
          cancelButtonColor:'#d33',
          confirmButtonText:'Yes, delete it!'
        }).then((result) => {
          if(result.value){
            axios
            .delete("suppliers/"+item.id)
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
          }
        });
      },

    }
}
</script>

<style>

</style>