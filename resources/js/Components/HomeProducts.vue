<template>

 <div class="product-double-row-area" >
 <div class="product-double-row-area" v-for="(cat , catindex) in cats" :key="cat.id">
     <div v-if="cat.products.length > 0"> 
        <div class="row">
            <div class="col-lg-12">

                <div class="section-title-area text-center">
                    <h2 class="section-title">{{ cat.LocalName }} </h2>

                </div>
            </div>
        </div>

        <div class="row" style="padding: 0 3.175%">
            <div class="col-lg-12">
                <!--=======  product row wrapper  =======-->

                <div class="product-row-wrapper">
                    <div class="row pb-5">
                           <div class="col-lg-3 col-md-4 col-6 col-custom-sm-6"  
                            v-for=" (n, itemIndex) in cat.toshow"  :key="itemIndex" >
                            <!--=======  single short view product  =======-->

                            <div class="single-grid-product" v-if="itemIndex < cat.products.length">
                                <div class="single-grid-product__image">
                                    <div class="product-badge-wrapper">
                                        <span class="onsale" v-if="cat.products[itemIndex].sale_price > 0">{{ Number(((cat.products[itemIndex].sale_price - cat.products[itemIndex].price)  /(cat.products[itemIndex].sale_price)*100).toFixed(0)) }} %</span>
                                        <span class="hot" v-if="cat.products[itemIndex].quantity < 1">Sold Out</span>
                                    </div>
                                    <a :href="'/product/'+ cat.products[itemIndex].slug  + '/' + session" class="image-wrap">
                                    <v-lazy-image width=350 height=525 v-if="cat.products[itemIndex].images.length " class="img-fluid" :alt="cat.products[itemIndex].LocalName"
                                     :src="'storage/products/medium_photos/'+ cat.products[itemIndex].images[0]['full']"
                                    :srcset="
                                    'storage/products/medium_photos/'+ cat.products[itemIndex].images[0]['full'] +' 860w ,'+
                                    'storage/products/medium_photos/'+ cat.products[itemIndex].images[0]['full'] +' 640w ,' +
                                    'storage/products/mobile_photos/'+ cat.products[itemIndex].images[0]['full'] +' 420w ,'
                                    "/>
                                    <v-lazy-image v-else src="/storage/placeholders/pr.jpg"  width=350 height=525 />                                    
                                   
                                    </a>
                                    <div class="product-hover-icon-wrapper">
                                        
                                        <span class="single-icon single-icon--add-to-cart" >
                                            <a :href="'/product/'+ cat.products[itemIndex].slug  + '/' + session"  >
                                            <i class="fa fa-shopping-basket"></i> <span v-if="cat.products[itemIndex].quantity > 0 " >SELECT OPTIONS</span><span v-else>Sold Out</span></a>
                                        </span>
                   
                                        
                                       
                                    </div>
                                     <ul class="sizes-list">  
                                                    
                                        <li class="size-item" v-for="size in cat.products[itemIndex].sizes" :key="size.id">
                                                <a title="M" :href="'/product/'+ cat.products[itemIndex].slug + '/' + session + '?variant='+ size.variation.id">
                                                {{ size.value }}
                                                </a>
                                            </li>                                                   
                                                      
                                     </ul>
                                </div>

                                <div class="single-grid-product__content">
                                    <h3 class="title"><a :href="'/product/' + cat.products[itemIndex].slug + '/' + session">{{cat.products[itemIndex].LocalName}} {{cat.products[itemIndex].catalog}}</a></h3>
                                    <div class="price"><span class="main-price discounted" v-if="cat.products[itemIndex].sale_price > 0">{{ cat.products[itemIndex].sale_price }}</span> <span class="discounted-price">{{ cat.products[itemIndex].price }}</span></div>
                                    <div class="color position-absolute" >
                                        <ul>
                                            <li  v-for="(color, colorIndex) in cat.products[itemIndex].colors" :key="colorIndex" :class="{ active: activeIndex === color.id} " :data-index="color.id">
                                                <a  class="active" href="#" :title="color.LocalValue" v-tooltip:top="color.LocalValue"   >
                                                    <a  v-if="color.image != null" @click.prevent="updateImage(catindex, itemIndex,color.image ,color.value , color.id)" >
                                                        <v-lazy-image  width=28 height=42 :src="'/storage/products/mobile_photos/'+ color.image" />
                                                    </a>
                                                  
                                                   <span @click.prevent="updateColor(catindex, itemIndex,color.value , color.id)" class="color-picker blue" :style="{ backgroundColor: color.colorcode }" v-if="color.image == null"></span>
                                            
                                                </a>
                                            </li>
                                                
                                             </ul>
                                    </div>
                                </div>
                            </div>

                            <!--=======  End of single short view product  =======-->
                        </div>
  </div>

                        <div class="infinite-scrolling-homepage" style=" position: relative; bottom: 39px;  width: 143px;" v-if="cat.toshow < cat.products.length">
                <a  @click.prevent= "loadMore(catindex)"  class= "btn btn--secondary-accent btn--big btn-product-show-more" data-collection="jeans" data-limit="4" data-page="2" data-total="" data-total-products="39" href="">
                  Show more
                </a>
            </div>
      </div>

                <!--=======  End of product row wrapper  =======-->
            </div>
        </div>
        </div>
    </div>
    
</div>
  </template>

<script>
  
import 'vue-popperjs/dist/vue-popper.css';  
import VLazyImage from 'v-lazy-image';
export default {
    components: { VLazyImage },
    
     data(){
        return{
            session: '',
            products:[],
            cats:[],
            moreExist : true ,
            nextPage: 0,
            activeIndex: 0,
            currentColor: '',



        }
    },
     created: function() {
            this.loadValues();
        },

         methods: {
            loadValues() {
                let _this = this;
                axios.post('/products/vue/get-values', {
                }).then (function(response){
                    console.log(response);
                    _this.session = response.data.session;
                    _this.products = response.data.products; 
                    _this.cats = response.data.cats;   
                     if(response.data.products.current_page < response.data.products.last_page ){
                 _this.moreExist = true ;
                 _this.nextPage = response.data.products.current_page +1 ;
                 }else{
                      _this.moreExist = false ;
                 }

                 console.log(response.data.products.current_page) ;
                }).catch(function (error) {
                    console.log(error);
                });
            },
            updateImage(catindex, itemIndex,itemimage, value, colorIndex) {
                 let _this = this;
                 console.log(itemimage);
                 _this.cats[catindex].products[itemIndex].images[0]['full'] = itemimage; 
                 
                 _this.cats[catindex].products[itemIndex].catalog = ' -' + value;   
                 if (_this.activeIndex === colorIndex) {
                    _this.activeIndex = 0;
                    } else {
                    _this.activeIndex = colorIndex;
                    }              
             },
             
            updateColor(catindex, itemIndex,value,  colorIndex) {
                 let _this = this;
                
                 _this.cats[catindex].products[itemIndex].catalog = ' -' + value;   
                 if (_this.activeIndex === colorIndex) {
                    _this.activeIndex = 0;
                    } else {
                    _this.activeIndex = colorIndex;
                    }              
             },
            loadMore(catindex){
                let _this = this;
            
                 _this.cats[catindex].toshow += _this.cats[catindex].increaseshow; 
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