<template>

            <div class="container">
                <div class="row">
                  
                    <div class="col-lg-7">
                        <!--=======  product details slider area  =======-->

                        <div class="product-details-slider-area product-details-slider-area--side-move">

                            <div class="row row-5" id="slider_selector_id">
                                <div class="col-md-9 order-1 order-md-2">
                                    <div class="big-image-wrapper">
                                        <div class="enlarge-icon">
                                            <a class="btn-zoom-popup" href="javascript:void(0)" data-tippy="Click to enlarge" data-tippy-placement="left" data-tippy-inertia="true" data-tippy-animation="shift-away" data-tippy-delay="50" data-tippy-arrow="true" data-tippy-theme="sharpborder"><i class="pe-7s-expand1"></i></a>
                                        </div>
                                        <Slick lass="product-details-big-image-slider-wrapper product-details-big-image-slider-wrapper--side-space theme-slick-slider" ref="slick"  :options="slickOptions"  id="nav-slider">  
                                            <div class="single-image zoom" v-for="image in product.images" :key="image.id">
                                                <img :src="'/storage/products/original_photos/'+ image.full" class="img-fluid" alt="">
                                            </div>
                                        </Slick>
                                    </div>
                                </div>

                                <div class="col-md-3 order-2 order-md-1" >
                                    <Slick ref="slickt"  :options="slickOptionst" class="product-details-small-image-slider-wrapper product-details-small-image-slider-wrapper--vertical-space theme-slick-slider" 
                                    >
                                            <div class="single-image" v-for="image in product.images" :key="image.id">
                                                <img :src="'/storage/products/medium_photos/'+ image.full" class="img-fluid" alt="">
                                            </div>
                                    </Slick>
                                </div>
                            </div>



                        </div>

                        <!--=======  End of product details slider area  =======-->
                    </div>
                    
  <div class="col-lg-5">
<div class="product-details-description-wrapper">
                   
<div class="quickview-wrapper open" v-if="loading">
<div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
</div>
<h2 class="item-title">{{ product.LocalName}}</h2>
<p class="price">
    <span class="main-price discounted" v-if="product.sale_price > 0 ">L.E {{ product.sale_price }}</span>
    <span class="discounted-price">L.E {{ product.price + var_price }}</span>

</p>

<p class="description"  v-html="product.LocalDescription"> </p>
<div class="swatch swatch_size_large" data-option-index="0">
<div class="header has-size-chart"  v-if="pickedSize != '0'">                
<span>
Size
</span>
:
<span data-option-select="">{{ pickedSize }}</span>
</div>


<div class="swatch-element 29 available" v-for="size in sizes" :key="size.id" > 
<input :id="'swatch-0-'+size.id" type="radio" name="option-0" :value="size.value" v-model="pickedSize">            
<label :for="'swatch-0-'+size.id" @click.prevent="variant(size.variation.id)">
{{ size.value}}
</label>
</div>

</div>
<div class="swatch swatch_size_large" data-option-index="1">
<div class="header"  v-if="pickedColor != 'null'">

<span >
Color
</span>
:
<span> {{ pickedColor }}</span>
</div>
<div  class="swatch-element color sky-blue available"  v-for="color in colors" :key="color.id">
    
<div class="tooltip">
{{color.value}}
</div>


<input :id="'swatch-0-'+color.value"  type="radio" name="option-1" :value="color.value" v-model="pickedColor"  @click="goToSlide(color.attribute.image , color.value)" >           

<label class="swatch_variant_img" :for="'swatch-0-'+color.value">
<span class="bgImg noimage"  :style=" 'background-color:' + color.attribute.colorcode" v-if="color.attribute.image == null">
</span>
<span class="bgImg with-image"  :style="'background-image: url(/storage/products/mobile_photos/'  + color.attribute.image + ')'" v-else ></span>
</label>
</div>
<div  class="swatch-element color sky-blue not-available"  v-for="ncolor in notAvColors" :key="ncolor.id">
    
    <div class="tooltip">
        {{ncolor.value}}
    </div>
    

    <input :id="'swatch-0-'+ncolor.value"  type="radio" name="option-1" :value="ncolor.value" disabled>           
    
    <label class="swatch_variant_img" :for="'swatch-0-'+ncolor.value">
        <span class="bgImg"  v-bind:style="{ 'background-color': ncolor.colorcode}">
        </span>
    </label>
    

</div>

</div>
<div  v-if="product.quantity > 0 || var_max_qty > 0">
<div class="pro-qty d-inline-block">
    <a  class="dec qty-btn"  @click.prevent="dec()"><i class="pe-7s-less"></i></a>
    <input type="text" v-model="qty" >
    <a  class="inc qty-btn"  @click.prevent="inc()"><i class="pe-7s-plus"></i></a>
</div>
<div class="add-to-cart-btn d-inline-block">
    <button class="theme-button theme-button--alt" @click.prevent="add()" >{{heading.addtocart}}</button>
   
</div>
</div>
<div class="add-to-cart-btn d-inline-block" v-else>
      <button class="theme-button theme-button--alt" disabled>Sold Out</button>
</div>
<div class="quick-view-other-info">
    


    <table>
        <tr class="single-info">
            <td class="quickview-title">SKU: </td>
            <td class="quickview-value">{{ product.sku }}</td>
        </tr>
        <tr class="single-info">
            <td class="quickview-title">{{heading.cats}}: </td>
            <td class="quickview-value">
                <a href="#" v-for="prcat in product.categories" :key="prcat.id">
                    {{prcat.LocalName}},</a>
            </td>
        </tr>
        <tr class="single-info">
            <td class="quickview-title">Share on: </td>
            <td class="quickview-value">
                <ul class="quickview-social-icons">
                    <li><a  :href="'https://www.facebook.com/sharer/sharer.php?u=' + 'https://beka-eg.com' + currentUrl"><i class="fa fa-facebook"></i></a></li>
                    <li><a  :href="'https://twitter.com/intent/tweet?text=' + 'https://beka-eg.com' + currentUrl"><i class="fa fa-twitter"></i></a></li>
                    <li><a  :href="'https://pinterest.com/pin/create/button/?url=' + 'https://beka-eg.com/storage/' + product.images[0].full + '&media=' +  'https://beka-eg.com' + currentUrl"><i class="fa fa-pinterest"></i></a></li>
                    <li><a  :href="'https://www.linkedin.com/shareArticle?mini=true&url=' + 'https://beka-eg.com' + currentUrl + '&title=' + product.LocalName "><i class="fa fa-linkedin"></i></a></li>
                </ul>
            </td>
        </tr>
    </table>
</div>
</div>



                    </div>
                </div>
            </div>
</template>
<script>

import Slick from 'vue-slick';
import Slickt from 'vue-slick';
export default {
    components: { Slick , Slickt },
props: {
   slug: String
 },
 
     data(){
        return{
            slickOptions: {                
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                autoplay: false,
                fade: true,
                speed: 500,
                prevArrow: {"buttonClass": "slick-prev", "iconClass": "fa fa-angle-left" },
                nextArrow: {"buttonClass": "slick-next", "iconClass": "fa fa-angle-right" },
                // Any other options that can be got from plugin documentation
                responsive: [
                            {
                            breakpoint: 1501,
                            settings: {
                                slidesToShow: 1,
                                arrows: true,
                            }
                            },
                            {
                            breakpoint: 1199,
                            settings: {
                                slidesToShow: 1,
                                arrows: false,
                            }
                            },
                            {
                            breakpoint: 991,
                            settings: {
                                slidesToShow: 1,
                                arrows: false,
                                slidesToScroll : 1
                            }
                            },
                            {
                            breakpoint: 767,
                            settings: {
                                slidesToShow: 1,
                                arrows: false,
                                slidesToScroll : 1
                            }
                            },
                            {
                            breakpoint: 575,
                            settings: {
                                slidesToShow: 1,
                                arrows: false,
                                slidesToScroll : 1
                            }
                            },
                            {
                            breakpoint: 479,
                            settings: {
                                slidesToShow: 1,
                                arrows: false,
                                slidesToScroll : 1
                            }
                            },
                            // You can unslick at a given breakpoint now by adding:
                            // settings: "unslick"
                            // instead of a settings object
                        ]
            },
             slickOptionst: {                
                slidesToShow:3,
                slidesToScroll: 1,
                arrows: true,
                autoplay: false,
                vertical: true,
                speed: 500,
                centerMode: false,
                asNavFor: "#nav-slider",
                focusOnSelect: true,
                prevArrow: {"buttonClass": "slick-prev", "iconClass": "fa fa-angle-left" },
                nextArrow: {"buttonClass": "slick-next", "iconClass": "fa fa-angle-right" },
                // Any other options that can be got from plugin documentation
                responsive: [
                            {
                            breakpoint: 1501,
                            settings: {
                                slidesToShow: 3,
                                arrows: false,
                            }
                            },
                            {
                            breakpoint: 1199,
                            settings: {
                                slidesToShow: 3,
                                arrows: false,
                            }
                            },
                            {
                            breakpoint: 991,
                            settings: {
                                slidesToShow: 3,
                                arrows: false,
                                slidesToScroll : 1
                            }
                            },
                            {
                            breakpoint: 767,
                            settings: {
                                slidesToShow: 3,
                                arrows: false,
                                vertical: false,
                                slidesToScroll : 1
                            }
                            },
                            {
                            breakpoint: 575,
                            settings: {
                                slidesToShow: 3,
                                arrows: false,
                                vertical: false,
                                slidesToScroll : 1
                            }
                            },
                            {
                            breakpoint: 479,
                            settings: {
                                slidesToShow: 2,
                                arrows: false,
                                vertical: false,
                                slidesToScroll : 1
                            }
                            },
                            // You can unslick at a given breakpoint now by adding:
                            // settings: "unslick"
                            // instead of a settings object
                        ]
            },
            product : [],            
            sizes : [],          
            colors : [],
            heading : [],
            notAvColors:[],
            qty : 1,            
            pickedSize : 1,
            pickedColor: 1 ,
            loading : false ,
            var_price : 0,
            var_max_qty: 0, 
            ReloadSlick: true , 
            cIndex : 0 ,
            var_id : 0 ,
            currentUrl: "",
           

        }
    },
     created: function() {
            this.loadValues();
             this.currentUrl = window.location.pathname;
           
            
        },
        
         methods: {
           
         goToSlide(image ,color) { 
                 let _this = this;
           _this.ReloadSlick = false ; 
            axios.get('/vue/product/colorvariant/', {
                     params: {
                    size : _this.pickedSize , 
                    color : color , 
                    product : _this.product.id , 

                    },
                }).then (function(response){
                    _this.var_price = response.data.var_price;
                    _this.var_max_qty = response.data.var_max_qty;
                    _this.var_id = response.data.var_id ;
                     if(_this.qty > response.data.var_max_qty ){
                        _this.qty = response.data.var_max_qty ;
                    }
                  
                    

                }).catch(function (error) {
                    console.log(error);
                });
             if(image != null){
                 
            _this.product.images.forEach((value,index ) => {
                if(value.full == image){
                    _this.cIndex = index
                }
            });
                _this.activeSlide = _this.cIndex;
                _this.$refs.slick.goTo(_this.cIndex);
                _this.$refs.slickt.goTo(_this.cIndex);
                 _this.$refs.slick.currentSlide(); 

             }
           

            
            },
            loadValues() {
                let _this = this;
              let  variant =  _this.$route.query.variant;
                axios.get('/vue/product/get-values/' + _this.slug +'/'+ variant, {
                }).then (function(response){
                     console.log(response);
                    _this.product = response.data.product;
                    _this.heading = response.data.heading;
                    _this.sizes = response.data.sizes;
                    _this.colors = response.data.colors;
                    _this.pickedSize = response.data.pickedSize;
                    _this.pickedColor = response.data.pickedColor;
                    _this.notAvColors = response.data.notAvColors;
                    _this.var_price = response.data.var_price;
                    _this.var_max_qty = response.data.var_max_qty;
                    _this.var_id = response.data.var_id ;
                    

                }).catch(function (error) {
                    console.log(error);
                });
            },
            variant(id){
                
                let _this = this;
                window.history.replaceState( {} , 'title', `?variant=${id}` );
               // $('#app').slick('slickGoTo', 1);
                //window.location = `?variant=${id}`;
                axios.get('/vue/product/get-values/' + _this.slug +'/'+ id, {
                    
                     params: {
                    pickedC : _this.pickedColor , 

                    },
                }).then (function(response){
                     console.log(response);
                    _this.product = response.data.product;
                    _this.heading = response.data.heading;
                    _this.sizes = response.data.sizes;
                    _this.colors = response.data.colors;
                    _this.notAvColors = response.data.notAvColors;
                    _this.pickedSize = response.data.pickedSize;
                    _this.pickedColor = response.data.pickedColor;
                    _this.var_price = response.data.var_price;
                    _this.var_max_qty = response.data.var_max_qty;
                    _this.var_id = response.data.var_id ;

                }).catch(function (error) {
                    console.log(error);
                });

            },
             add() {            
                this.loading = true ;
                let _this = this;
                axios.get('/product/add/cart/single/en', {
                    params: {
                    productId : _this.product.id,
                    quantity : _this.qty ,
                    price : 1,
                    size: _this.pickedSize,
                    color: _this.pickedColor,
                    var_id: _this.var_id,

                    },
                }).then (function(response){
                    // console.log(response);
                    _this.loading = false ;
                    if(response.data.status){
                    _this.$root.$emit('itemAdded');                     
                 _this.$toaster.success(response.data.added)

                    }else{
                 _this.$toaster.error(response.data.error)

                    }                    

                }).catch(function (error) {
                    console.log(error);
                });
             },
            inc() {
                 if(this.qty < this.var_max_qty  && this.product.quantity > 0 &&  this.var_max_qty > 0){
                this.qty =  this.qty + 1 ;

                 }
            },
            
            dec() {
                if(this.qty != 1 ){
                this.qty =  this.qty - 1 ;

                }
            },
         },
         mounted () {
   // Your JQuery code here
    if (this.$refs.slick) {
            this.$refs.slick.destroy();
        }
         if (this.$refs.slickt) {
            this.$refs.slickt.destroy();
        }
  
},
          beforeUpdate() {
       
    },
    updated() {
        this.$nextTick(function () {
                 if (this.$refs.slick && this.ReloadSlick) {
                 this.$refs.slick.create(this.slickOptions);
            }
             if (this.$refs.slickt  && this.ReloadSlick) {
                 this.$refs.slickt.create(this.slickOptionst);
            }
               $('.single-image.zoom').zoom();

    //lightgallery 
	var productThumb = $(".single-image img"),
	imageSrcLength = productThumb.length,
	images = [];
	for (var i = 0; i < imageSrcLength; i++) {
		images[i] = {"src": productThumb[i].src};
	}

	$('.btn-zoom-popup').on('click', function () {
		$(this).lightGallery({
			thumbnail: false,
			dynamic: true,
			autoplayControls: false,
			download: false,
			actualSize: false,
			share: false,
			hash: false,
			index: 0,
			dynamicEl: images
		});
	});
               
        });
    },
           
        

}
</script>
<style scoped>
button.theme-button.theme-button--alt:disabled {
    opacity: .5;
    cursor: not-allowed;
    user-select: none;
}
.swatch.swatch_size_large {
    margin-bottom: 20px;
}
.swatch.swatch_size_large .header {
    font-size: 15px;
    line-height: 24px;
    color: grey;
}
.swatch .header {
    font-size: var(--font_size);
    font-weight: 600;
    line-height: 20px;
    color: var(--page_title_color);
    margin-bottom: 0.5rem;
}
.swatch.swatch_size_large .swatch-element {
    margin: 0 10px 15px 0;
}
.swatch .swatch-element {
    display: -webkit-inline-box;
    display: -webkit-inline-flex;
    display: -moz-inline-flex;
    display: -ms-inline-flexbox;
    display: inline-flex;
    margin: 0 10px 12px 0;
    position: relative;
}
.swatch input[type=radio] {
    display: none;
}
input[type=checkbox], input[type=radio] {
    box-sizing: border-box;
    padding: 0;
}
button, input {
    overflow: visible;
}
.swatch.swatch_size_large .swatch-element:not(.color) input:checked+label {
    background-color: #fff;
    border: 1px solid #ccc;
    font-weight: 600;
    box-shadow: 0px 0px 10px;
    box-shadow: 0px 0px 10px #80808045;
}
.swatch.swatch_size_large .swatch-element.color input:checked+label {
   
    box-shadow: 0px 0px 10px #80808045;
}
.swatch.swatch_size_large .swatch-element:not(.color) label {
    min-width: 50px;
    height: 50px;
    line-height: 41px !important;
}
.swatch.swatch_size_large .swatch-element:not(.color) label {
    font-size: 15px;
    line-height: 26px;
}
.swatch .swatch-element input:checked+label {
    font-weight: 600;
}
.swatch.swatch_size_large .swatch-element label {
    border-radius: 0;
    background-color: #eaeaea;
}
.swatch .swatch-element label {
    min-width: 34px;
    height: 34px;
    border: 1px solid var(--border_color_2);
    margin: 0;
    text-align: center;
    padding: 3px;
    line-height: var(--font_size_plus14);
    color: var(--color_slick_arrow);
    cursor: pointer;
    border-radius: var(--border-radius-17);
}
.swatch.swatch_size_large .swatch-element.color label {
    width: 70px;
    height: 70px;
    border-radius: 50%;
    font-weight: bold;
}
.swatch.swatch_size_large .swatch-element.color input:checked+label:before {
    border-color: #fff;
}
.swatch .swatch-element .bgImg {
    display: block;
    width: 100%;
    height: 100%;
    -moz-border-radius: 50%;
    -webkit-border-radius: 50%;
    -ms-border-radius: 50%;
    -o-border-radius: 50%;
    border-radius: 50%;
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    border-radius: 50%;
}
.swatch.swatch_size_large .swatch-element.color label:after {
    display: block;
    content: "";
    position: absolute;
    border: 1px solid transparent;
    width: calc(100% - 2px);
    height: calc(100% - 2px);
    left: 1px;
    top: 1px;
    border-radius:50%;
}
.swatch.swatch_size_large .swatch-element.color label:before {
    content: '';
    width: 14px;
    height: 8px;
    position: absolute;
    top: calc(50% - 7px);
    left: calc(50% - 4px);
    border: 2px solid transparent;
    border-top: none;
    border-right: none;
    background: rgba(255,255,255,0);
    transition: all .2s ease;
    opacity: 1;
    transform: scale(1) rotate(
-45deg
);
}
.not-available label{
        opacity: .5;
    user-select: none;
    cursor: not-allowed !important;
}
</style>