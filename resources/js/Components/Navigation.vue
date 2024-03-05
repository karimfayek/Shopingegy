<template>
   <ul >

                                        <li>
                                            <a :href="'/'+ session">{{ heading.home }}</a>

                                        </li>
                                        <li v-for="page in pages" :key="page.id">
                                          <a :href="'/page/' +  page.slug + '/' + session ">{{ page.LocalName }}</a>
                                        </li>
                                        <li class="has-children">
                                            <a :href="'#'" >{{heading.products}}</a>
                                            <ul class="submenu submenu--column-1">
                                                <li v-for=" item in categories" :class="{ 'has-children': item.children.length > 0 }" :key="item.id" >
                                                   <a :href="'/category2/' + item.slug +'/' + session">{{item.LocalName}}</a>
													<ul v-if="item.children.length > 0" class="submenu submenu--column-1">
                                                        <li v-for="subitem in item.children" :key="subitem.id">
                                                            <a :href="'/category2/' + subitem.slug +'/' + session ">
                                                                {{subitem.LocalName}}
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>

                                        <li >
                                            <a :href="'/contact/' + session">{{ heading.contact }}</a>
                                        </li>

                                    </ul>
</template>

<script>
export default {
     data(){
        return{
            session: '',
            heading:[],
            pages:[],
            categories:[],
            hasChildren: "",



        }
    },
     created: function() {
            this.loadValues();
        },
         methods: {
            loadValues() {
                let _this = this;
                axios.post('/pages/get-values', {
                }).then (function(response){
                    console.log(response);
                    _this.heading = response.data.heading;
                    _this.session = response.data.session;
                    _this.pages = response.data.pages;
                    _this.categories = response.data.categories;
                    _this.hasChildren = response.data.categories.length ;
                }).catch(function (error) {
                    console.log(error);
                });
            },
         },
         computed:{


         }

}
</script>
