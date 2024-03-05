<template>
    <div class="col-12">
         <div class="quickview-wrapper open"  v-if="loading">
        <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
        </div>
                        <div class="checkout-form" v-if="cartCount > 0 && !submited">
                            <!-- Checkout Form s-->
                            <form action="#" novalidate>
                                <div class="row row-40">

                                    <div class="col-lg-7">

                                        <!-- Billing Address -->
                                        <div id="billing-form" class="billing-form">
                                            <h4 class="checkout-title">{{ heading.checkout }}</h4>

                                            <div class="row">

                                                <div class="col-md-6 col-12">
                                                    <label>{{ heading.firstname }}*</label>
                                                    <input type="text" :placeholder="heading.firstname" v-model="firstname">
                                                    <div v-show="firstNameError" style="color:red">
                                                        .. First name Is too short
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-12">
                                                    <label>{{ heading.lastname }}*</label>
                                                    <input type="text" :placeholder=" heading.lastname " v-model="lastname">
                                                     <div v-show="lastNameError" style="color:red">
                                                        .. Last name Is too short
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-12">
                                                    <label>{{ heading.email}}</label>
                                                    <input type="email" :placeholder=" heading.email" v-model="email" name="email">
                                                   
                                                </div>

                                                <div class="col-md-6 col-12">
                                                    <label>{{ heading.phone}}*</label>
                                                    <input type="text" :placeholder=" heading.phone" v-model="phone">
                                                     <div v-show="phoneError" style="color:red">
                                                        .. phone number Is invalid
                                                    </div>
                                                </div>


                                                <div class="col-12">
                                                    <label>{{ heading.address}}*</label>
                                                    <input type="text" :placeholder=" heading.address" v-model="address">
                                                     <div v-show="addressError" style="color:red">
                                                        .. Address is too short
                                                    </div>
                                                </div>

                                                <div class="col-md-6 col-12">
                                                     <div class="form-group">
                                                    <label>{{ heading.city}} *</label>
                                                    <div class="select-box">
                                                        <select name="country" class="form-control form-control-md"  v-model="city"  @change="changecity()" >
                                                            <option disabled value="">Please select one</option>
                                                            <option :value="state.id" v-for="state in states" :key="state.id" >{{ state.name }} + {{ state.ship_price }}</option>
                                                            
                                                        </select>
                                                        <div v-show="cityError" style="color:red">
                                                                .. City Is required
                                                            </div>
                                                    </div>
                                                </div>
                                                </div>

                                            </div>

                                        </div>

                                       

                                    </div>

                                    <div class="col-lg-5">
                                        <div class="row">

                                            <!-- Cart Total -->
                                            <div class="col-12">

                                                <h4 class="checkout-title">Cart Total</h4>

                                                <div class="checkout-cart-total">

                                                    <h4>Product <span>Total</span></h4>

                                                    <ul v-for="item in cart" :key="item.id">
                                                        <li>{{item.LocalName}} X {{item.quantity}} <span>L.E {{ item.price }}</span></li>
                                                       
                                                    </ul>

                                                    <p>Sub Total <span>L.E {{ cart_sub_total }}</span></p>
                                                     <p>Shiping <small v-if="cityName != null ">to {{ cityName }}  </small> <span>L.E {{ shipping}}</span></p>

                                                    <h4>Grand Total <span>L.E {{cart_total}}</span></h4>

                                                </div>

                                            </div>

                                            <!-- Payment Method -->
                                            <div class="col-12">

                                                <h4 class="checkout-title">Payment Method</h4>

                                                <div class="checkout-payment-method">
                                                  

                                                    <div class="single-method">
                                                        <input type="radio" id="payment_cash" name="payment-method" value="cash" checked disabled>
                                                        <label for="payment_cash">Cash on Delivery</label>
                                                        <p data-method="cash">Please send a Check to Store name with Store Street, Store Town, Store State, Store Postcode, Store Country.</p>
                                                    </div>

                                                   

                                                </div>

                                                <button  @click.prevent="checkout"  class="theme-button place-order-btn" :disabled="!isValidForm">PLACE ORDER</button>

                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                        
                        <div class="text-center" v-if="cartCount < 1  && !submited " >Cart Empty</div>
                <div class="text-center" style="width:100vw" v-if="submited" >
            	
        
       
                    <div class="order-success text-center font-weight-bolder text-dark">
                        <i class="fas fa-check"></i>
                        Thank you. Your order has been received.
                    </div>
                    <!-- End of Order Success -->

                    <ul class="order-view list-style-none">
                        <li>
                            <label>Order number</label>
                            <strong>{{ order.order_number }}</strong>
                        </li>
                        <li>
                            <label>Status</label>
                            <strong>On hold</strong>
                        </li>
                        <li>
                            <label>Date</label>
                            <strong>{{ order.created_at }}</strong>
                        </li>
                        <li>
                            <label>Total</label>
                            <strong>L.E {{ order.grand_total }}</strong>
                        </li>
                        <li>
                            <label>Payment method</label>
                            <strong>Cash On delivery</strong>
                        </li>
                    </ul>
                    <!-- End of Order View -->
<hr>
                    <div class="order-details-wrapper mb-5">
                        <h4 class="title text-uppercase ls-25 mb-5">Order Details</h4>
                        <table class="cart-table">
                            <thead>
                                <tr>
                                    <th class="text-dark">Product</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="pr in order.items" :key="pr.id">
                                    <td>
                                        <a href="#">{{ pr.product.name }}</a>&nbsp;<strong>x {{ pr.quantity }}</strong><br>
                                       
                                    </td>
                                    <td>{{ pr.price }}</td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Payment method:</th>
                                    <td>Cash On delivery</td>
                                </tr>
                                <tr class="total">
                                    <th class="border-no">Total:</th>
                                    <td class="border-no">L.E {{ order.grand_total }}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- End of Order Details -->
 

        </div>
          <div class="text-center" style="width:100vw" v-if="submited && !success" >
<h3 class="text-danger">OOps , Something went wrong. Please try again later </h3>
          </div>
                    </div>
</template>

<script>
export default {
     data(){
        return{
            cart_sub_total :'',
            cart_total: '',
            firstname: '',
            lastname: '',            
            email: '',
            phone :'',
            city: '',
            address: '',
            companyname: '',
            heading:[], 
            user:[],           
            cart:[],             
            states:[], 
            session: '' ,
            cartCount: '',
            notes: '',
            submited: false,
            loading: true,
            shipping : 0,
            order:[],
            cityName : null ,
            success : false ,


        }
    },
     created: function() {
            this.loadValues();            
          this.$root.$on('itemRemoved', (data) => { this.loadValues(); })
        },
         methods: {
            loadValues() {
                let _this = this;
                axios.post('/checkout/get-values', {
                }).then (function(response){
                     console.log(response);
                    _this.heading = response.data.heading;
                    _this.cart = response.data.cart_content;
                    _this.session = response.data.session;
                    _this.cart_total = response.data.cart_total;
                    _this.cart_sub_total = response.data.cart_sub_total;
                    _this.cartCount = response.data.cartCount;
                    _this.states = response.data.states;
                    _this.shipping = response.data.shipping;
                    _this.cityName = response.data.cityName;
                   _this.loading = false ;
                   
                }).catch(function (error) {
                    console.log(error);
                });
            },
            checkout() {
                let _this = this;					
                _this.loading = true ;
                
                axios.post('/checkout/order/nocc', {
                    first_name: _this.firstname,
				  last_name: _this.lastname,
				  address: _this.address,
				  phone: _this.phone,
				  city: _this.city,
				  email: _this.email,
				  country: 'Egypt',
				  company: _this.companyname,
				  notes: _this.notes,
                  

                   
                }).then (function(response){
                  //console.log(response);					
                     _this.$root.$emit('itemAdded')
                   _this.submited = true ; 	
                   _this.loading = false ; 	
                   _this.order = response.data.order; 
                   _this.success = response.data.status; 
                location.href = `/thank-you/${response.data.order.order_number}`;		
                }).catch(function (error) {
                    console.log(error);
                });
			},
            
            changecity() {
                let _this = this;					
                   _this.loading = true ;
                  // location.href = '/some_url.php';
                axios.post('/shipping/set', {
                    val: 'no',
				  state: _this.city,
                  

                   
                }).then (function(response){
                  console.log(response);
                    _this.cart_total = response.data.carttotal;
                    _this.cart_sub_total = response.data.cart_sub_total;
                    _this.shipping = response.data.condvalue;		
                    _this.cityName = response.data.cityName;	
                   _this.loading = false ; 		
                }).catch(function (error) {
                    console.log(error);
                });
			},
         },
         computed:{
             firstNameError(){
                 return this.firstname.length > 0 &&  this.firstname.length < 3 
             },
             lastNameError(){
                 return this.lastname.length > 0 &&  this.lastname.length < 3 
             },
             phoneError(){
                 return this.phone.length > 0 &&  this.phone.length < 11 
             },
             addressError(){
                 return this.address.length > 0 &&  this.address.length < 10 
             },
             cityError(){
                 return  this.city.length < 3 
             },
            
              isValidForm(){
                 
                  return this.firstname.length > 2 && this.lastname.length > 2 &&  this.phone.length > 10 && this.address.length > 10  && this.city 
             }
         }

}
</script>
