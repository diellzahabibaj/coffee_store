<template>

    
    <div class="row">
        <div class="form-group">
        <form @submit.prevent="submit">     
            <table class="table table-bordered" >
   
    
         
        <div class="alert alert-success" v-show="success">Order created successfully.
            </div> 
            
                <div class="row form-group">
                    <div class="col-md-12">
                       <td> <label for="product_id">Product name</label>
                        <select name="product_id" class="form-control" v-model="fields.product_id">
                         <option v-for="product in products"
                            :key="product.id">{{product.name}}
                         </option>
                        </select>
                           
                       </td>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-12">
                       <td> <label for="product_id">Product price</label>
                        <select name="product_id" class="form-control" v-model="fields.product_id">
                         <option v-for="product in products"
                            :key="product.id">{{ product.price}}
                         </option>
                        </select>
                           
                       </td>
                    </div>
                </div> 
                <div class="row form-group">
                    <div class="col-md-12">
                        <td> <label for="quantity">Qty</label>
                            
                            <input type="number" id="quantity" name="quantity" v-model="fields.quantity" class="form-control" value="0" />
                            
                        
                       
                       
                        </td>
                    </div>
                </div> 
                <div class="row form-group">
                    <div class="col-md-12">
                      <td>  
                       
                       
                      <li  v-for="product in products" :key="product.id">
                      <button type="button" class="btn btn-primary btn-block">+</button>
                      </li>
                      
                      </td>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-12">
                    
                      <td>  
                        
                        <li  v-for="product in products" :key="product.id">
                        
                        <button type="button" class="btn btn-primary btn-block">-</button>
                        </li>
                       </td>
                    </div>
                </div>
            </table>
            <div class="form-group">
                <div class="col-md-12">
                    <label for="">Total</label>
             
                  
                    <input type="number" name="total" class="form-control" step="any" />
                   
                </div>
            </div>

                <div class="form-group">
                    <div class="col-md-12">
                       <td> <label for="customer_id">Customer</label>
                        <select name="customer_id" class="form-control" v-model="fields.customer_id">
                         <option v-for="customer in customers"
                            :key="customer.id">{{ customer.first_name}}
                         </option>
                        </select>
                           
                       </td>
                    </div>
                </div>
                 
                <div class="form-group">
                    <div class="col-md-12">
                        <label for="">Order time : </label>
                        
                        <input type="date" name="order_time" v-model="fields.order_time" class="form-control">
                       
                    </div>
                </div>  
      
        <div class="col-lg-12">
            
            <button type="submit" class="btn btn-xs btn-primary" >Buy</button>
        </div>

    </form>
        </div>
</div>
</template>
<script>
export default {
    data(){
        return {
                products:[],
                orders: [],
                customers: [],
                fields: {},
                success: false
        }
    },
    created() {
       this.loadOrders();

    },  
    methods: {
        loadOrders(){
            axios.get("/api/orders").then(({data})=>(this.orders = data));
        },
        submit() {
            axios.post('/api/orders', this.fields).then(response => {
                this.fields = {};
                this.success = true;

            }).catch( function(error) {
                console.log(error); 
            });
        }
    }
    
}
</script>