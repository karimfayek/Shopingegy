<template>
    	<div class="page-content-wrapper">
        <!--=======  shopping cart wrapper  =======-->

        <div class="shopping-cart-area">
            <div class="container">
                <div class="row">
                    <div class="w-100">
                        <div  class="progress-meter"
                            :style="'position: relative;display: block;height: 100%;background-color: rgb(47 137 88);text-align: center;line-height: 15px;color: #ffffff;width:'+  calcFreeShip()  +'%;-webkit-animation: 2s linear 0s normal none infinite running progress-bar-stripes;animation: 2s linear 0s normal none infinite running progress-bar-stripes;background-image: -webkit-linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);background-image: linear-gradient(45deg,rgba(255,255,255,.15) 25%,rgba(0,0,0,0) 25%,rgba(0,0,0,0) 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,rgba(0,0,0,0) 75%,rgba(0,0,0,0));background-size: 40px 40px;transition: 0.9s linear;transition-property: width, background-color;'">
                            {{  calcFreeShip() }}%
                        </div>
                    </div>
<div  v-if="cart_freeship_diff > 0" class="free_shipping_massage1">
    <span class="hidden">Only LE {{ cart_freeship_diff }}.00 </span>away from<b>  free shipping </b>
</div>
<div  v-else class="free_shipping_massage1"> <span class="hidden">You quality for free shipping </span> </div>

	<form action="/cart/update/m" method="get" class="w-100">				
                    <div class="col-lg-12" v-if="cartCount > 0">					
                        <!--=======  cart table  =======-->

                        <div class="cart-table-container">
						
                            <table class="cart-table">
                                <thead>
                                    <tr>
                                        <th class="product-name" colspan="2">Product</th>
                                        <th class="product-price">Price</th>
                                        <th class="product-quantity">Quantity</th>
                                        <th class="product-subtotal">Total</th>
                                        <th class="product-remove">&nbsp;</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr v-for="item in cartItems" :key="item.id">
										
                                        <td class="product-thumbnail">
                                            <a :href="'/product/' + item.associatedModel.slug +'/' + session">
                                                <img width="90" height="118" :src="'/storage/products/mobile_photos/'+ item.firstimage"
                                                 class="img-fluid" alt="">
                                            </a>
                                        </td>
                                        <td class="product-name">
                                            <a :href="'/product/' + item.slug +'/' + session">{{item.LocalName}}</a>
                                            <p class="font-italic">{{ item.attributes.size }} /  {{ item.attributes.color }}</p>  
                                        </td>

                                        <td class="product-price"><span class="price">L.E {{item.price}}</span></td>

                                        <td class="product-quantity">
                                            <div class="pro-qty d-inline-block mx-0">
                                                <a href="#" class="dec qty-btn" @click.prevent="dec(item.quantity, item.id)"><i class="pe-7s-less"></i></a>
                                                  <input
                                                    :value=item.quantity 
                                                    type="text"
                                                    step="1"
                                                    min="1"
                                                    title="Qty"
                                                    size="4"
                                                    placeholder=""
                                                    inputmode="numeric" style="
                                                    
                                                    margin: 0;
                                                "/>
                                            <a href="#" class="inc qty-btn" @click.prevent="inc(item.quantity , item.id, item.maxQty)"><i class="pe-7s-plus"></i></a>
															  
                                            </div>
                                        </td>

                                        <td class="total-price"><span class="price">L.E {{ item.getPriceSumWithConditions }}</span></td>

                                        <td class="product-remove">
                                            <a href="#" @click.prevent="deleteItem(item.id)">
                                                <i class="pe-7s-close"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    
                                </tbody>
                            </table>
							
                        </div>

                        <!--=======  End of cart table  =======-->
                    </div>
</form>
                    <div class="col-lg-6 offset-lg-6"  v-if="cartCount > 0">
                        <div class="cart-calculation-area">
                            <h2 class="cart-calculation-area__title">Cart totals</h2>

                            <table class="cart-calculation-table">
                                <tr>
                                    <th>SUBTOTAL</th>
                                    <td class="subtotal">L.E {{ cart_sub_total}}</td>
                                </tr>
                                <tr>
                                    <th>TOTAL</th>
                                    <td class="total">L.E {{ cart_total}}</td>
                                </tr>
                            </table>

                            <div class="cart-calculation-button">
                                <a :href="'/checkout/'+ session" class="theme-button theme-button--alt theme-button--checkout">PROCEED TO CHECKOUT</a>
                            </div>
                        </div>
                    </div>
         <h3 class="text-center " v-else> Cart Empty</h3>
        
                </div>
            </div>
        </div>

        <!--=======  End of shopping cart wrapper  =======-->
        
<div class="quickview-wrapper open" v-if="loading">
<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
</div> 
    </div>
</template>

<script>

export default {

     data(){
        return{
            session: '', 
            cartItems: [],
            cartCount: '',
            heading : [],
            cart_total : '',
            cart_sub_total: '',
            loading : true ,
            qty : 1,
            cart_freeship_diff: null ,
            freeshippingVale: null ,

        }
    },
     created: function() {
            this.loadValues();
          this.$root.$on('itemAdded', (data) => { this.loadValues(); })
          this.$root.$on('itemRemoved', (data) => { this.loadValues(); })
            
        },
         methods: {
              calcFreeShip(){
                const  diff = ((this.freeshippingVale - this.cart_freeship_diff  )  / this.freeshippingVale) *100 
                if(diff > 100){
                    return 100
                }
                
                return Number((diff).toFixed(0));   ;
              } ,
            loadValues() {
                let _this = this;
                axios.get('/vue/cart/get-values/', {
                }).then (function(response){
                    
                    _this.cartItems = response.data.cartItems;
                    _this.session = response.data.session;
                    _this.cartCount = response.data.cartCount;
                    _this.cart_total = response.data.cart_total;
                    _this.cart_sub_total = response.data.cart_sub_total;
                    _this.heading = response.data.heading;
                    _this.freeshippingVale = response.data.freeshippingVale;
                    _this.cart_freeship_diff = response.data.cart_freeship_diff;
                    _this.loading = false ;
                }).catch(function (error) {
                    console.log(error);
                });
            },
             deleteItem(id) {
                let _this = this;
                
                    _this.loading = true ;
                axios.get('/cart/item/' + id + '/remove', {
                }).then (function(response){ 

                     _this.$root.$emit('itemAdded')
                     _this.loadValues();

                    _this.loading = false ;
                }).catch(function (error) {
                    console.log(error);
                });
            },
               inc(qnty, pr , maxQty) {
                let _this = this;
                if(maxQty > qnty){
                     _this.qty =  qnty;
                    //console.log(  _this.qty + 1);
                        _this.loading = true ;
                    axios.get('/cart/update/m/vue', {
                        params: {
                        qty :  parseInt(qnty) + 1 ,
                        pr : pr ,
                        }
                    }).then (function(response){ 

                        _this.$root.$emit('itemAdded')
                        _this.loadValues();

                        _this.loading = false ;
                    }).catch(function (error) {
                        console.log(error);
                    });

                }
                
            },
            
             dec(qnty , pr) {
                 if(qnty != 1){
                    let _this = this;
                
                    _this.loading = true ;
                    axios.get('/cart/update/m/vue', {
                    params: {
                    qty : parseInt(qnty) - 1 ,
                    
                    pr : pr ,

                    }
                }).then (function(response){ 

                     _this.$root.$emit('itemAdded')
                     _this.loadValues();

                    _this.loading = false ;
                }).catch(function (error) {
                    console.log(error);
                });
                 }
               
            },
         },
         computed:{
           
         }

}
</script>