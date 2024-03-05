<template>
    <div>
        <div class="tile">
            <h3 class="tile-title">Attributes</h3>
            <hr>
            <div class="tile-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="parent">Select an Attribute <span class="m-l-5 text-danger"> *</span></label>
                            <select id=parent class="form-control custom-select mt-15" v-model="attribute" @change="selectAttribute(attribute)">
                                <option :value="attribute" v-for="attribute in attributes"> {{ attribute.name }} </option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tile" v-if="attributeSelected">
            <h3 class="tile-title">Add Attributes To Product</h3>
            <div class="row">
                
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="values">Select an value <span class="m-l-5 text-danger"> *</span></label>
                        <select id=values class="form-control custom-select mt-15" v-model="value" @change="selectValue(value)">
                            <option :value="value" v-for="value in attributeValues"> {{ value.value }} </option>
                        </select>
                    </div>
                </div>
                  <div class="col-md-4" v-if="attribute.id == 30 && valueSelected">
                    <div class="form-group">
                        <label class="control-label" for="Image">Image</label>
                        <ul class= "form-control" name="Image" id="Image" @click="selectimageclicked = true">
                        <li  v-for="image in images" :key="image.id"  @click="selectImage(image.full, image.id)"  > 
                            <img :src="'/storage/products/mobile_photos/' +  image.full " style="max-width:50px" :class="{ active: image.id == selectedimgaeId, 'text-danger': false }">
                        </li>
                        </ul>
                        
                    </div>
                </div>
            </div>
               
              
                <div class="col-md-12">
                    <button class="btn btn-sm btn-primary" @click="addProductAttribute()">
                        <i class="fa fa-plus"></i> Add
                    </button>
                </div>
        </div>
        <div class="tile">
            <h3 class="tile-title">Product Attributes</h3>
            <div class="tile-body">
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                        <tr class="text-center">
                            <th>Value</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="pa in productAttributes">
                            <td style="width: 33.33%" class="text-center">{{ pa.value}}</td>
                            <td style="width: 33.33%" class="text-center"><img :src="'/storage/products/mobile_photos/' + pa.image" style="
    max-width: 100px;
"> </td>
                            <td style="width: 33.33%" class="text-center">
                                <button class="btn btn-sm btn-danger" @click="deleteProductAttribute(pa)">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "product-attributes",
        props: ['productid'],
        data() {
            return {
                productAttributes: [],
                attributes: [],
                images : [],
                attribute: {},
                attributeSelected: false,
                attributeValues: [],
                value: {},
                valueSelected: false,
                currentAttributeId: '',
                currentValue: '',
                currentValueAr: '',
                colorcode: null,
                currentValueID: '',
                currentQty: 1,
                currentPrice: 0,
                currentImage: '',
                selectimageclicked: false  ,
                selectedimgaeId : 0 , 
            }
        },
        created: function() {
            this.loadAttributes();
            this.loadProductAttributes(this.productid);
        },
        methods: {
            selectImage(image , id) {
                let _this = this;
                    _this.currentImage = image;
                    _this.selectedimgaeId = id ;

            },
            loadAttributes() {
                let _this = this;
                axios.get('/admin/products/attributes/load').then (function(response){
                    _this.attributes = response.data;
                }).catch(function (error) {
                    console.log(error);
                });
            },
            loadProductAttributes(id) {
                let _this = this;
                axios.post('/admin/products/attributes', {
                    id: id
                }).then (function(response){
                    _this.productAttributes = response.data.attributes;
                    _this.images = response.data.images;
                }).catch(function (error) {
                    console.log(error);
                });
            },
            selectAttribute(attribute) {
                let _this = this;
                this.currentAttributeId = attribute.id;
                axios.post('/admin/products/attributes/values', {
                    id: attribute.id,
                    prid: _this.productid
                }).then (function(response){
                    _this.attributeValues = response.data;
                     console.log(response);
                }).catch(function (error) {
                    console.log(error);
                });
                this.attributeSelected = true;
            },
            selectValue(value) {
                this.valueSelected = true;
                this.currentValue = value.value;
                this.currentValueAr = value.valuear;
                this.currentValueID = value.id;
                if(this.currentAttributeId == 30){
                this.colorcode = value.color;

                }
            },
            addProductAttribute() {
                if (this.currentQty === null || this.currentPrice === null) {
                    this.$swal("Error, Some values are missing.", {
                        icon: "error",
                    });
                } else {
                    let _this = this;
                    let data = {
                        attribute_id: this.currentAttributeId,
                        value:  this.currentValue,
                        valuear:  this.currentValueAr,
                        valueid:  this.currentValueID,
                        quantity: this.currentQty,
                        colorcode: this.colorcode,
                        image: this.currentImage,
                        price: 0,
                        product_id: this.productid,
                    };

                    axios.post('/admin/products/attributes/add', {
                        data: data
                    }).then (function(response){
                        _this.$swal("Success! " + response.data.message, {
                            icon: "success",
                        });
                        _this.currentValue = '';
                        _this.currentValueID = '';
                        _this.currentQty = '';
                        _this.currentImage = '';
                        _this.currentPrice = '';
                        _this.selectedimgaeId = 0 , 
                        _this.valueSelected = false;
                    }).catch(function (error) {
                        console.log(error);
                    });
                    this.loadProductAttributes(this.productid);
                }
            },
            deleteProductAttribute(pa) {
                let _this = this;
                this.$swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this data!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        console.log(pa.id);
                        axios.post('/admin/products/attributes/delete', {
                            id: pa.id,
                        }).then (function(response){
                            if (response.data.status === 'success') {
                                _this.$swal("Success! Product attribute has been deleted!", {
                                    icon: "success",
                                });
                            } else {
                                _this.$swal("Your Product attribute not deleted!");
                            }
                        }).catch(function (error) {
                            console.log(error);
                        });
                    } else {
                        this.$swal("Action cancelled!");
                    }
                });
                                this.loadProductAttributes(this.productid);

            }
        }
    }
</script>
<style scoped>
.active {
        box-shadow: 0px 0px 10px;
}
ul.form-control {
    max-height: 129px;
    overflow: auto;
}
</style>
