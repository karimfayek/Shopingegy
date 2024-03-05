<template>
     <div>
          <div class="breadcrumb-area section-space--breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <!--=======  breadcrumb wrapper  =======-->

                    <div class="breadcrumb-wrapper">
                        <h2 class="page-title">{{heading.contact}}</h2>
                        <ul class="breadcrumb-list">
							<li><a :href="'/' + session ">{{heading.home}}</a></li>
                            <li class="active">{{heading.contact}}</li>
                        </ul>
                    </div>

                    <!--=======  End of breadcrumb wrapper  =======-->
                </div>
            </div>
        </div>
    </div>
    <!--====================  End of breadcrumb area  ====================-->
     <!--====================  page content wrapper ====================-->

    <div class="page-content-wrapper">

        <!--=======  map area  =======-->

        <div class="box-layout-map-area section-space">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!--=======  box layout map container  =======-->

                        <div class="box-layout-map-container" v-html="map">
                          
                        </div>

                        <!--=======  End of box layout map container  =======-->
                    </div>
                </div>
            </div>
        </div>

        <!--=======  End of map area  =======-->

        <!--=======  contact icon text  =======-->

        <div class="contact-icon-text-area section-space">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!--=======  contact icon text wrapper  =======-->

                        <div class="contact-icon-text-wrapper">
                            <div class="row">
                                <div class="col-sm-4">
                                    <!--=======  single contact icon text  =======-->

                                    <div class="single-contact-icon-text">
                                        <div class="single-contact-icon-text__icon">
                                            <i class="fa fa-map-marker"></i>
                                        </div>
                                        <h3 class="single-contact-icon-text__title">{{heading.address}}</h3>
                                        <p class="single-contact-icon-text__value">{{ address }}</p>
                                    </div>

                                    <!--=======  End of single contact icon text  =======-->
                                </div>
                                <div class="col-sm-4">
                                    <!--=======  single contact icon text  =======-->

                                    <div class="single-contact-icon-text">
                                        <div class="single-contact-icon-text__icon">
                                            <i class="fa fa-phone"></i>
                                        </div>
                                        <h3 class="single-contact-icon-text__title">{{heading.phone}}</h3>
                                        <p class="single-contact-icon-text__value">{{ phone }}</p>
                                    </div>

                                    <!--=======  End of single contact icon text  =======-->
                                </div>
                                <div class="col-sm-4">
                                    <!--=======  single contact icon text  =======-->

                                    <div class="single-contact-icon-text">
                                        <div class="single-contact-icon-text__icon">
                                            <i class="fa fa-envelope"></i>
                                        </div>
                                        <h3 class="single-contact-icon-text__title">{{heading.email}}</h3>
                                        <p class="single-contact-icon-text__value">{{ defaultEmail }}</p>
                                    </div>

                                    <!--=======  End of single contact icon text  =======-->
                                </div>
                            </div>
                        </div>

                        <!--=======  End of contact icon text wrapper  =======-->
                    </div>
                </div>
            </div>
        </div>

        <!--=======  End of contact icon text  =======-->

        <!--=======  contact form with content  =======-->

        <div class="contact-form-content-area section-space--contact-form">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!--=======  contact form content wrapper  =======-->

                        <div class="contact-form-content-wrapper">
                            <div class="row">
                                <div class="col-md-8">
                                    <!--=======  contact form wrapper  =======-->

                                    <div class="contact-form-wrapper">
                                        <form id="contact-form" action="/contactm" method="post">
                                            <div class="row">
                                                <div class=" col-sm-6">
                                                    <input type="text" placeholder="First Name *" name="name" id="customername" required>
                                                </div>
                                                <div class=" col-sm-6">
                                                    <input type="text" placeholder="Email *" name="email" id="customerEmail" required>
                                                </div>
                                                <div class="col-lg-12">
                                                    <textarea cols="30" rows="10" placeholder="Message *" name="message" id="contactMessage" required></textarea>
                                                </div>
                                                <div class="col-lg-12">
                                                    <button type="submit" id="submit" class="theme-button"> {{heading.sendmessage }}</button>
                                                </div>
                                            </div>
                                        </form>
                                        <p class="form-messege"></p>
                                    </div>


                                    <!--=======  End of contact form wrapper  =======-->
                                </div>

                                <div class="col-md-4">
                                    <!--=======  contact form content  =======-->

                                    <div class="contact-form-content">
                                        

                                        <ul class="social-links">
                                            <li><a :href='facebook'><i class="fa fa-facebook"></i></a></li>
                                            <li><a :href='instagram'><i class="fa fa-instagram"></i></a></li>
                                        </ul>
                                    </div>

                                    <!--=======  End of contact form content  =======-->
                                </div>
                            </div>
                        </div>

                        <!--=======  End of contact form content wrapper  =======-->
                    </div>
                </div>
            </div>
        </div>

        <!--=======  End of contact form with content  =======-->

    </div>

    <!--====================  End of page content wrapper  ====================-->
     </div>
</template>


<script>
export default {
     data(){
        return{
            session: '',
            heading:[], 
			defaultEmail :'',
			map:'',
			phone :'',
            address: '',
            facebook: '',
            instagram: '',


        }
    },
     created: function() {
            this.loadValues();
        },
         methods: {
            loadValues() {
                let _this = this;
                axios.get('/vue/contact/get-values/', {
                }).then (function(response){
                     //console.log(response);
                    _this.heading = response.data.heading;
                    _this.session = response.data.session;
                    _this.defaultEmail = response.data.defaultEmail;
                    _this.map = response.data.map;
                    _this.phone = response.data.phone;
                    _this.address = response.data.address;
                    _this.facebook = response.data.facebook;
                    _this.instagram = response.data.instagram;
                }).catch(function (error) {
                    console.log(error);
                });
            },
         },
         computed:{
           
         }

}
</script>
