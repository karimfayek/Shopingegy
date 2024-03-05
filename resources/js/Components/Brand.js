import React, { useEffect, useState } from 'react';
import Axios from 'axios';
import 'react-loading-skeleton/dist/skeleton.css';
import Slider from 'rc-slider';
import 'rc-slider/assets/index.css';
import CatGrid from './common/CatGrid';
import ProductSkeleton from './common/ProductSkeleton';
import CatList from './common/CatList';
import Toaste from './common/Toaste';

const Brand = ({ slug, id }) => {
    const [rangeValues, setRangeValues] = useState([]);
    const [minPrice, setMinPrice] = useState(0);
    const [maxPrice, setMaxPrice] = useState(0);
    const [products, setProducts] = useState([])
    const [cats, setCats] = useState([])
    const [layout, setLayout] = useState('list')
    const [selecteCats, setSelecteCats] = useState([]);
    const [initialLoad, setInitialLoad] = useState(true);
    const [brands, setBrands] = useState('')
    const [loading, setLoading] = useState(true)
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
        setLoading(true)
        Axios.post(`/api/filter-products/brand`, {
            categorySlug: slug,
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
        Axios.get(`/api/brand/${slug}`).then(
            response => {
                setProducts(response.data.products)
                setCats(response.data.cats)
                setRangeValues([response.data.minPrice, response.data.maxPrice]);
                setMinPrice(response.data.minPrice)
                setMaxPrice(response.data.maxPrice)

            }
        )
        ///
        Axios.get('/api/brands').then(
            response => {
                setBrands(response.data.brands)

            }
        )
        setLoading(false)

    }, [slug]);

    /////


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
        Axios.post(`/api/filter-products/brand`, {
            categorySlug: slug,
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

    }, [selecteCats]);



    return (
        <div style={{ padding: "0 59px" }}>
            <div className="row row-50 novi-disabled">
                <Toaste />
                <div className="col-lg-3">
                    <div className="row row-40 row-md-50">
                    <div className="col-sm-6 col-md-4 col-lg-12"><h6>Brands</h6>
                            <div className="offset-xs">
                                <ul className='list list-marked-arrow'>
                                    {brands && brands.map((brand) =>
                                        <li className="font-weight-bold list-item" key={brand.id}>
                                            <a className={brand.id != id ? "text-700 text-monospace" : "text-500 text-monospace"} href={brand.id != id ? "/brand/" + brand.slug : '#b'}>{brand.name}</a> </li>

                                    )}
                                </ul>
                            </div>
                        </div>
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
export default Brand