<template>
<div>
     <div class="breadcrumb-area section-space--breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <!--=======  breadcrumb wrapper  =======-->

                    <div class="breadcrumb-wrapper">
                        <h1 class="page-title">{{page.LocalName}}</h1>
                        <ul class="breadcrumb-list"><li><a href="/">{{heading.home}}</a></li>
                            <li class="active">{{page.LocalName}}</li>
                        </ul>
                    </div>

                    <!--=======  End of breadcrumb wrapper  =======-->
                </div>
            </div>
        </div>
    </div>

    <!--====================  End of breadcrumb area  ====================-->

      <div class="page-content-wrapper">

        <!--=======  about page top wrapper  =======-->

        <div class="about-page-top-wrapper section-space">
            <!--=======  about us brief wrapper  =======-->

            <div class="about-us-brief-wrapper section-space--small">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <div class="about-us-brief-desc" v-html=" page.LocalDescription ">

							</div>
                        </div>
                    </div>
                </div>
            </div>

            <!--=======  End of about us brief wrapper  =======-->
            </div>
              </div>
</div>

</template>
<script>
export default {
     data(){
        return{
            session: '',
            heading:[],
            page:[],


        }
    },
     created: function() {
            this.loadValues();
        },
         methods: {
            loadValues() {
                let _this = this;
                axios.post('/page/details/get-values/'+ this.$route.params.slug, {
                }).then (function(response){
                     console.log(response);
                    _this.heading = response.data.heading;
                    _this.session = response.data.session;
                    _this.page = response.data.page;
                }).catch(function (error) {
                    console.log(error);
                });
            },
         },
         computed:{

         }

}
</script>
