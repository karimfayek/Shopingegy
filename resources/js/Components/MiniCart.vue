<template>
<li>
    <a :href="'/cart/'+ session"><i class="fa fa-shopping-basket"></i><span id="cartcount" class="item-count">{{ cartCount }}</span></a>

    <div class="minicart-wrapper">

        <p class="minicart-wrapper__title">{{ heading['cart']}}</p>
<div  class="progress-meter"
     :style="'position: relative;display: block;height: 100%;background-color: rgb(47 137 88);text-align: center;line-height: 15px;color: #ffffff;width:'+  calcFreeShip()  +'%;-webkit-animation: 2s linear 0s normal none infinite running progress-bar-stripes;animation: 2s linear 0s normal none infinite running progress-bar-stripes;background-image: -webkit-linear-gradient(45deg,rgba(255,255,255,.15) 25%,transparent 25%,transparent 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,transparent 75%,transparent);background-image: linear-gradient(45deg,rgba(255,255,255,.15) 25%,rgba(0,0,0,0) 25%,rgba(0,0,0,0) 50%,rgba(255,255,255,.15) 50%,rgba(255,255,255,.15) 75%,rgba(0,0,0,0) 75%,rgba(0,0,0,0));background-size: 40px 40px;transition: 0.9s linear;transition-property: width, background-color;'">{{  calcFreeShip() }}%</div>
<div  v-if="cart_freeship_diff > 0" class="free_shipping_massage1">
    <span class="hidden">Only LE {{ cart_freeship_diff }}.00 </span>away from<b>  free shipping </b>
</div>
<div  v-else class="free_shipping_massage1"> <span class="hidden">You quality for free shipping </span> </div>

        <div class="minicart-wrapper__items ps-scroll  ps--active-y" v-if="cartCount > 0" >
            <div id="minicart">
                <div class="minicart-wrapper__items__single" v-for="item in cartItems" :key="item.id" >
                <a :href="'#'" class="close-icon"><i class="pe-7s-close" @click.prevent="deleteItem(item.id)"></i></a>
                <div class="image">
                <a :href="'/product/'+ item.associatedModel.slug +'/'+ session">
                <img  width="90" height="100" :src="'/storage/products/mobile_photos/' + item.firstimage " class="img-fluid" alt="">
                </a>
                </div>
                <div class="content">
                <p class="product-title"><a :href="'/product/'+ item.associatedModel.slug +'/'+ session">{{item.LocalName}}</a>
               
                </p>
                
               <p class="font-italic">{{ item.attributes.size }} /  {{ item.attributes.color }}</p>  
                <p class="product-calculation"><span class="count">{{item.quantity}}</span> x <span class="price">L.E {{item.price}}</span></p>
                </div>
                </div>
            </div>

        <p class="minicart-wrapper__subtotal" >Total: <span id="carttotal">L.E  {{ cart_total  }}</span></p>

        <div class="minicart-wrapper__buttons">
            <a :href="'/cart/'+ session" class="theme-button theme-button--minicart-button">{{ heading['viewcart']}}</a>
            <a :href="'/checkout/'+ session" class="theme-button theme-button--alt theme-button--minicart-button theme-button--minicart-button--alt mb-0">{{ heading['checkout']}}</a>
        </div>

        <div class="quickview-wrapper open" v-if="loading">
        <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
        </div>
    </div>
    <div v-else>
        <p class="text-center">Cart Empty</p>
    </div>

    </div>
</li>

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
            loading : false ,
            cart_freeship_diff: null ,
            freeshippingVale: null ,

        }
    },
     created: function() {
            this.loadValues();
          this.$root.$on('itemAdded', (data) => {      this.loadValues();    });

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
                axios.get('/vue/minicart/get-values/', {

                }).then (function(response){

                    _this.cartItems = response.data.cartItems;
                    _this.session = response.data.session;
                    _this.cartCount = response.data.cartCount;
                    _this.cart_total = response.data.cart_total;
                    _this.freeshippingVale = response.data.freeshippingVale;
                    _this.cart_freeship_diff = response.data.cart_freeship_diff;
                    _this.heading = response.data.heading;
                JQuery('#itemCountM').html(response.data.cartCount);

                }).catch(function (error) {
                    console.log(error);
                });
            },
             deleteItem(id) {
                let _this = this;

                    _this.loading = true ;
                axios.get('/cart/item/' + id + '/remove', {
                }).then (function(response){

                     _this.$root.$emit('itemRemoved')
                     _this.loadValues();
                    _this.loading = false ;
                }).catch(function (error) {
                    console.log(error);
                });
            },
         },
         computed:{

         }

}
</script>
<style >
.free_shipping_massage1 {
    margin-top: 2px;
    margin-bottom: 20px;
    color: #3c3c3c;
    font-size: 12px;
    text-align: left;
}
.free_shipping_massage1 b {
    color: #000;
    text-transform: capitalize;
}
</style>
