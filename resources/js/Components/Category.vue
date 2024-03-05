<template>

                            <div class="shop-product-wrap shop-product-wrap--with-sidebar row grid">
<div class="col-lg-4 col-md-6 col-sm-6 col-custom-sm-6 col-12"  v-for="(pr, itemIndex) in products" :key="pr.id">

    <!--=======  grid view product  =======-->
    <div class="single-grid-product">
        <div class="single-grid-product__image">
            <div class="product-badge-wrapper">
                <span class="onsale" v-if="pr.sale_price > 0">{{ Number(((pr.sale_price - pr.price)  /(pr.sale_price)*100).toFixed(0)) }} %</span>
            </div>
            <a :href="'/product/'+ pr.slug + '/' + session " class="image-wrap">
             <v-lazy-image  width=350 height=525  class="img-fluid" :alt=" pr.LocalName"
                    :src="'/storage/products/medium_photos/'+  pr.firstimage "
                :srcset="
                '/storage/products/medium_photos/'+  pr.firstimage +' 860w ,'+
                '/storage/products/medium_photos/'+  pr.firstimage +' 640w ,' +
                '/storage/products/mobile_photos/'+  pr.firstimage +' 420w ,'
                "/>
                <v-lazy-image v-if="pr.lastimage !== 'undefined'" class="img-fluid" :alt=" pr.LocalName"
                    :src="'/storage/products/medium_photos/'+ pr.lastimage"
                :srcset="
                '/storage/products/medium_photos/'+  pr.lastimage +' 860w ,'+
                '/storage/products/medium_photos/'+  pr.lastimage +' 640w ,' +
                '/storage/products/mobile_photos/'+  pr.lastimage +' 420w ,'
                "/>
            </a>
            <div class="product-hover-icon-wrapper">
                
                <span class="single-icon single-icon--add-to-cart">
                <a :href="'/product/' + pr.slug + '/'+ session"  >
                <i class="fa fa-shopping-basket"></i> <span>Select Options</span> </a>
                </span>
                
            </div>
             <ul class="sizes-list">  

                <li class="size-item" v-for="size in pr.sizes" :key="size.id">
                    <a title="M" :href="'/product/'+ pr.slug + '/' + session + '?variant='+ size.variation.id">
                    {{ size.value }}
                    </a>
                </li>                                                 
                            
            </ul>
        </div>
        <div class="single-grid-product__content">
            <h3 class="title"><a :href="'/product/'+ pr.slug + '/' + session ">{{ pr.LocalName }}  {{pr.catalog}}</a></h3>
            <div class="price">
            <span class="main-price discounted" v-if="pr.sale_price > 0 ">L.E {{ pr.sale_price }}</span> 
           
            <span class="discounted-price">L.E {{pr.price}}</span>
            </div>
            <div class="color">
                <ul>
                    <li  v-for="(color, colorIndex) in pr.colors" :key="colorIndex" :class="{ active: activeIndex === color.id} " :data-index="color.id">
                        <a   class="active" href="#" data-placement="top" :title="color.LocalValue" v-tooltip:top="color.LocalValue"   >
                            
                              <v-lazy-image  width=28 height=42  :src="'/storage/products/mobile_photos/'+ color.image" v-if="color.image != null" @click.prevent="updateImage(itemIndex,color.image ,color.LocalValue , color.id)" />
                            <span @click.prevent="updateColor(itemIndex,color.LocalValue , color.id)" class="color-picker blue" :style="{ backgroundColor: color.colorcode }" v-if="color.image == null"></span>
                    
                        </a>
                    </li>
                        
                </ul>
            </div>
            
        </div>
    </div>

    <!--=======  End of grid view product  =======-->

    <!--=======  list view product  =======-->

    <div class="single-list-product">

        <div class="single-list-product__image">                                            
            <a :href="'/product/'+ pr.slug + '/' + session " class="image-wrap">
                <v-lazy-image class="img-fluid" :alt=" pr.LocalName"
                    :src="'/storage/products/medium_photos/'+  pr.firstimage "
                :srcset="
                '/storage/products/medium_photos/'+  pr.firstimage +' 860w ,'+
                '/storage/products/medium_photos/'+  pr.firstimage +' 640w ,' +
                '/storage/products/mobile_photos/'+  pr.firstimage +' 420w ,'
                "/>
                <v-lazy-image v-if="pr.lastimage !== 'undefined'" class="img-fluid" :alt=" pr.LocalName"
                    :src="'/storage/products/medium_photos/'+ pr.lastimage"
                :srcset="
                '/storage/products/medium_photos/'+  pr.lastimage +' 860w ,'+
                '/storage/products/medium_photos/'+  pr.lastimage +' 640w ,' +
                '/storage/products/mobile_photos/'+  pr.lastimage +' 420w ,'
                "/>
            </a>
        </div>

        <div class="single-list-product__content">
            <h3 class="title"><a :href="'/product/'+ pr.slug + '/' + session ">{{ pr.LocalName}}</a></h3>
            <div class="price">
            <span class="main-price discounted" v-if="pr.sale_price > 0 ">L.E {{pr.sale_price}}</span> 
            
            <span class="discounted-price">L.E {{pr.price}}</span></div>
            
            <p class="product-short-desc"  v-html="pr.LocalDescription"></p>


            <div class="product-hover-icon-wrapper">
                
                <span class="single-icon single-icon--add-to-cart">
                <a href="#"  @click.prevent="addToCart(pr.id)"  >
                <i class="fa fa-shopping-basket"></i> <span>ADD TO CART</span></a></span>
                
            </div>

        </div>
    </div>
    <!--=======  End of list view product  =======-->

</div>
<div class="quickview-wrapper open" v-if="loading">
<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
</div> 
</div> 

	
</template>

<script>

import VLazyImage from 'v-lazy-image';
export default {
components: { VLazyImage },
 props: {
   slug: String
 },
     data(){
        return{
            session: '',
            products:[], 
            loading : true ,            
            activeIndex: 0,
            currentColor: '',

        }
    },
     created: function() {
            this.loadValues();
        },
        mounted(){
            // JQuery("[rel='tooltip']").tooltip();
        },
         methods: {
            loadValues() {
                let _this = this;
                axios.get('/vue/catproducts/get-values/' + _this.slug, {
                }).then (function(response){
                     //console.log(response);
                    _this.products = response.data.products;
                    _this.session = response.data.session;
                    _this.loading = false ;
                }).catch(function (error) {
                    console.log(error);
                });
            },
            addToCart(id) {
                
                this.loading = true ;
                let _this = this;
                axios.get('/product/add/cart/single/en', {
                    params: {
                    productId : id,
                    quantity : 1 ,
                    price : 1

                    }
                }).then (function(response){
                    
                    _this.loading = false ;
                     _this.$root.$emit('itemAdded')
                }).catch(function (error) {
                    console.log(error);
                });
            },
            updateImage( itemIndex,itemimage, value, colorIndex) {
                 let _this = this;
                 //console.log(itemimage);
                 _this.products[itemIndex].firstimage = itemimage; 
                 
                 _this.products[itemIndex].catalog = ' -' + value;   
                 if (_this.activeIndex === colorIndex) {
                    _this.activeIndex = 0;
                    } else {
                    _this.activeIndex = colorIndex;
                    }              
             },
             
            updateColor(itemIndex,value,  colorIndex) {
                 let _this = this;
                 _this.products[itemIndex].catalog = ' -' + value; 
                   
                 if (_this.activeIndex === colorIndex) {
                    _this.activeIndex = 0;
                    } else {
                    _this.activeIndex = colorIndex;
                    }              
             },
         },
             
         computed:{
           
         }

}
</script>

<style scoped>
    .section-title-area {
    margin-top: 50px;
}
.sizes-list {
    margin-bottom: 0;
    visibility: hidden;
    opacity: 0;
    position: absolute;
    bottom: 0;
    left: 43px;
}
.single-grid-product:hover .sizes-list {
    visibility: visible;
    opacity: 1;
}
.sizes-list {
    margin: 0 0 15px;
    letter-spacing: -.33em;
}
.sizes-list li:first-of-type {
    margin-left: 0;
}
.sizes-list li {
    display: inline-block;
    letter-spacing: normal;
    margin: 0 2.5px 0;
}
.sizes-list li a {
    min-width: 27px;
    -moz-border-radius: 13px;
    -webkit-border-radius: 13px;
    -ms-border-radius: 13px;
    -o-border-radius: 13px;
    border-radius: 13px;
    color: #2d2d2d;
    border: 1px solid #e7e7e7;
    background-color: #fff;
    display: block;
    text-align: center;
    padding: 3px 5px 2px;
    font-weight: 500;
}
.sizes-list li a:hover {
    background:#000;
    color: #fff;
    border-color: #000;
}
.color ul li.active {
    -webkit-box-shadow: 0 0 0 1.5px #000;
    -moz-box-shadow: 0 0 0 1.5px #000;
    box-shadow: 0 0 0 1.5px #000;
}
</style>