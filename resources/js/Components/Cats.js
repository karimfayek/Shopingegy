import React, { useEffect, useState } from 'react';
import Axios from 'axios';
import 'react-loading-skeleton/dist/skeleton.css';
import Slider from 'rc-slider';
import 'rc-slider/assets/index.css';
import CatGrid from './common/CatGrid';
import ProductSkeleton from './common/ProductSkeleton';
import CatList from './common/CatList';
import Toaste from './common/Toaste';



const Cats = ({ slug }) => {
    const [rangeValues, setRangeValues] = useState([]);
    const [minPrice, setMinPrice] = useState(0);
    const [maxPrice, setMaxPrice] = useState(0);
    const [products, setProducts] = useState([])
    const [cats, setCats] = useState([])
    const [layout, setLayout] = useState('list')
    const [selectedBrands, setSelectedBrands] = useState([]);
    const [selecteCats, setSelecteCats] = useState([]);
    const [initialLoad, setInitialLoad] = useState(true);
    const [initialLoad2, setInitialLoad2] = useState(true);
    const [brands, setBrands] = useState('')
    const [loading, setLoading] = useState(true)



    //// handleRangeChange
    const handleRangeChange = (values) => {
        setRangeValues(values);


    };


    /////
    useEffect(() => {
        const delayTimer = setTimeout(() => {
            filterProducts();
        }, 500);

        return () => clearTimeout(delayTimer);
    }, [rangeValues]);

    ///// 


    const filterProducts = () => {
        if (initialLoad2) {
            // Skip the initial load
            setInitialLoad2(false)
            return;
        }
        setLoading(true)

        Axios.post(`/api/filter-products`, {
            categorySlug: slug,
            selectedBrands: selectedBrands,
            cats: selecteCats,
            prices: [rangeValues[0], rangeValues[1]],
        }).then((response) => {

            // Handle the response and update the products
            setProducts(response.data.filteredProducts);

            if (response.data.minPrice !== null && response.data.maxPrice !== null) {
                setMinPrice(response.data.minPrice);
                setMaxPrice(response.data.maxPrice);
                
            }


        }).catch((error) => {
            console.log(error)
        });
        setTimeout(() => {
            setLoading(false)

        }, 2000);
    };

    // ///
    useEffect(() => {
        setLoading(true)
        Axios.get(`/api/cats/${slug}`).then(
            response => {
                setProducts(response.data.products)
                setCats(response.data.children)
                setRangeValues([response.data.minPrice, response.data.maxPrice]);
                setMinPrice(response.data.minPrice)
                setMaxPrice(response.data.maxPrice)
                console.log('products', response.data.products)

            }
        )
        setLoading(false)


    }, []);
    useEffect(() => {
        setLoading(true)
        const fetchBrands = async () => {
            try {
                const response = await Axios.get('/api/brands');
                setBrands(response.data.brands);
            } catch (error) {
                console.error('Error fetching brands:', error);
            }
        };

        fetchBrands();
        setLoading(false)
    }, []);


    /////
    const handleCheckboxChange = (event, brandId) => {
        if (event.target.checked) {
            setSelectedBrands((prevSelectedBrands) => [...prevSelectedBrands, brandId]);
        } else {
            setSelectedBrands((prevSelectedBrands) =>
                prevSelectedBrands.filter((id) => id !== brandId)
            );
        }


    };

    ///// handle filter Cats
    const handleCheckboxChangeCat = (event, catId) => {
        if (event.target.checked) {
            setSelecteCats((prevSelectedCats) => [...prevSelectedCats, catId]);
        } else {
            setSelecteCats((prevSelectedCats) =>
                prevSelectedCats.filter((id) => id !== catId)
            );
        }


    };

    /////
    const handleLayoutChange = (l) => {
        setLayout(l)
    };

    /////
    useEffect(() => {
        if (initialLoad) {
            // Skip the initial load
            setInitialLoad(false);
            return;
        }
        setLoading(true)
        Axios.post(`/api/filter-products`, {
            categorySlug: slug,
            selectedBrands: selectedBrands,
            cats: selecteCats,
            prices: [rangeValues[0], rangeValues[1]],
        }).then((response) => {

            // Handle the response and update the products
            setProducts(response.data.filteredProducts);
            if (response.data.minPrice !== null && response.data.maxPrice !== null) {
                setMinPrice(response.data.minPrice);
                setMaxPrice(response.data.maxPrice);

            }


        }).catch((error) => {
            console.log(error)
        });
        setTimeout(() => {
            setLoading(false)
        }, 2000);

    }, [selectedBrands, selecteCats]);

   
    return (
        <div style={{ padding: "0 59px" }}>
            <div className="row row-50 novi-disabled">
                <Toaste />
                <div className="col-lg-3">
                    <div className="row row-40 row-md-50">
                        {cats.length > 0 && <div className="col-sm-6 col-md-4 col-lg-12"><h6>Categories</h6>
                            <div className="offset-xs">
                                {cats.length > 0 && cats.map((cat) =>
                                    <div className="custom-control custom-checkbox" key={cat.id}>
                                        <input className="custom-control-input" type="checkbox" id={'check' + cat.id} onChange={(event) => handleCheckboxChangeCat(event, cat.id)} />
                                        <label className="custom-control-label" htmlFor={'check' + cat.id}> {cat.name} </label>
                                    </div>
                                )}

                            </div>
                        </div>}
                        <div className="col-sm-6 col-md-4 col-lg-12"><h6>Brands</h6>
                            <div className="offset-xs">
                                {brands && brands.map((brand) =>
                                    <div className="custom-control custom-checkbox" key={brand.id}>
                                        <input className="custom-control-input" type="checkbox" id={'check' + brand.id} onChange={(event) => handleCheckboxChange(event, brand.id)} />
                                        <label className="custom-control-label" htmlFor={'check' + brand.id}> {brand.name} </label>
                                    </div>
                                )}

                            </div>
                        </div>

                        <div className="col-md-4 col-lg-12"><h6>Price</h6>
                            <div className="offset-xs">
                                Min: {rangeValues[0]} | Max: {rangeValues[1]}
                                <Slider
                                    range
                                    min={minPrice}
                                    max={maxPrice}
                                    value={rangeValues}
                                    onChange={handleRangeChange}
                                />
                            </div>
                        </div>
                    </div>
                </div>
                {products.length > 0 &&
                    <div className="col-lg-9">
                        <div className="product-toolbar justify-content-center justify-content-sm-between">
                            <div className="product-toolbar-item">
                                <div className="group-20"><a className={layout == "grid" ? 'product-toolbar-icon icon-xs int-grid novi-icon active' : 'product-toolbar-icon icon-xs int-grid novi-icon'} href="#g" onClick={() => handleLayoutChange('grid')}></a><a className={layout == "list" ? 'product-toolbar-icon icon-xs int-list novi-icon active' : 'product-toolbar-icon icon-xs int-list novi-icon'} href="#g" onClick={() => handleLayoutChange('list')}></a></div>
                            </div>
                        </div>
                        <div className="row row-40 row-md-60 row-offset-lg">
                            {loading ? (
                                <div>
                                    {Array.from({ length: 10 }, (_, index) => (
                                        <ProductSkeleton key={index} />
                                    ))}

                                </div>
                            ) :
                                (
                                    products && layout == 'list' ? (
                                        <CatList products={products} />
                                    ) :
                                        (
                                            <CatGrid products={products} />
                                        )
                                )}
                        </div>
                    </div>
                }
                {products.length < 1 &&

                    <div className="col-lg-9">
                        <p>No Products here yet</p>

                    </div>
                }
            </div>
        </div>
    )
}
export default Cats