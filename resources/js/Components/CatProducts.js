import React, { useState, useEffect } from 'react'
import Axios from 'axios';
import Toaste from './common/Toaste';
import Product from './includes/Product';
import ProductList from './includes/ProductList';
import CategoryProductSceleton from './common/CategoryProductSceleton';

const CatProducts = ({ slug }) => {

    const [products, setProducts] = useState([])
    const [category, setCategory] = useState({})
    const [loading, setLoading] = useState(true)
    const [catPrCount, setCatPrCount] = useState(0)
    const [currentPage, setCurrentPage] = useState(1);
    const [layOut, setLayout] = useState('grid');
    const [lastPage, setLastPage] = useState(1);
    const [sortDropDownOpened, setSortDropDownOpened] = useState(false)
    const [selectedSort, setSelectedSort] = useState('Default sorting')
    const [minPrice, setMinPrice] = useState('');
    const [maxPrice, setMaxPrice] = useState('');

    //translation 
    const { local, productstrans, showing, of, to, categories, sortby, priceasc, pricedesc, pricetrans , pricefromtrans , pricetotrans} = headings

    const handleSortDropDown = () => {
        setSortDropDownOpened(!sortDropDownOpened)
    }
    const handleSortText = () => {
        if (selectedSort === 'priceasc') {
            return priceasc
        }
        if (selectedSort === 'pricedesc') {
            return pricedesc
        }
        return sortby
    }
    const handleSelectSortDropDown = (e, val) => {
        e.preventDefault()
        setSelectedSort(val)
        setSortDropDownOpened(false)
    }

    useEffect(() => {
        setLoading(true);
        Axios.get(`/api/catproducts/${slug}?page=${currentPage}`)
            .then((response) => {
                const responseData = response.data;
                if (responseData && responseData.products && Array.isArray(responseData.products.data)) {
                    setProducts(responseData.products);
                    setCategory(responseData.category);
                    console.log(responseData)
                    setLastPage(responseData.products.last_page);
                } else {
                    console.error("Invalid response structure:", responseData);
                }
            })
            .catch((error) => {
                console.error("API request failed:", error);
            })
            .finally(() => {
                setLoading(false);
            });
    }, [slug, currentPage]);

    // Sort products
    useEffect(() => {
        if (products.data && products.data.length > 0) {
            setProducts((prevProducts) => {
                return { ...prevProducts, data: sortProducts(prevProducts.data, selectedSort) };
            });
        }
    }, [selectedSort]);

    const sortProducts = (products, sorting) => {
        return [...products].sort((a, b) => {
            if (sorting === 'priceasc') {
                return a.price - b.price;
            } else {
                return b.price - a.price;
            }
        });
    };
    const handlePriceFilter = () => {
        // Filter products based on price range
        const filteredProducts = products.data.filter(product => {
            const price = parseFloat(product.price);
            return (isNaN(price) || (minPrice === '' || price >= parseFloat(minPrice)) && (maxPrice === '' || price <= parseFloat(maxPrice)));
        });

        // Update the products state with the filtered products
        setProducts((prevProducts) => ({ ...prevProducts, data: filteredProducts }));
    };
    const handlePageChange = (page) => {
        if (page >= 1 && page <= lastPage) {
            setCurrentPage(page);
        }
    };
    if (loading) {
        return <CategoryProductSceleton />
    }
    return (
        <>
            <Toaste />
            <div className="col-xl-3 col-lg-3 col-md-12 col-12 sidebar left-sidebar md-b-50 rtl">

                <div className="block block-product-cats">
                    {(category.children.length > 0 || category.parent_id != '1') &&
                        <>

                            <div className="block-title"><h2>{categories}</h2></div>
                            <div className="block-content">
                                <div className="product-cats-list">
                                    <ul>
                                        {category.children.length > 0 &&
                                            category.children.map(
                                                (child) =>
                                                    <li className="current" key={child.id}>
                                                        <a href={"/category/" + child.slug + '/' + local}> {child.LocalName} <span className="count">{child.products.length}</span></a>
                                                    </li>
                                            )

                                        }

                                        {category.parent && category.parent.id !== 1 ? (
                                            <li className="current">
                                                <a href={"/category/" + category.parent.slug + '/' + local}>{category.parent.LocalName} <span className="count">{catPrCount}</span></a>
                                            </li>
                                        ) : null}



                                    </ul>
                                </div>
                            </div>
                        </>
                    }
                </div>
                <div className="block block-product-filter">
                    <div className="block-title"><h2>{pricetrans}</h2></div>
                    <div className="block-content">
                        <div className="row textRight" style={{ flexDirection: 'row', flexWrap: 'nowrap' }}>
                            <div className="m-1">
                                <label>{pricefromtrans}</label>
                                <input type='number' className='form-control' name="pricefrom" value={minPrice} onChange={(e) => setMinPrice(e.target.value)} />
                            </div>
                            <div className="m-1">
                                <label>{pricetotrans}</label>
                                <input type='number' className='form-control' name="priceto" value={maxPrice} onChange={(e) => setMaxPrice(e.target.value)} />

                            </div>
                            <div className="m-1">

                                <label> </label>
                                <input type='submit' className='form-control' value={'go'} onClick={() => handlePriceFilter()} style={{
                                    position: 'relative',
                                    top: 8,
                                    background: 'black',
                                    color: ' #fff',
                                    cursor: 'pointer'
                                }}
                                disabled={minPrice < 1 || maxPrice < 1}
                                />

                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div className="col-xl-9 col-lg-9 col-md-12 col-12">


                <div className="products-topbar clearfix">
                    <div className="products-topbar-left">
                        <div className="products-count rtl">
                            {showing} {products.from} {to} {products.to} {of} {products.total} {productstrans}
                        </div>
                    </div>
                    <div className="products-topbar-right">
                        <div className="products-sort dropdown">
                            <span className="sort-toggle dropdown-toggle" data-toggle="dropdown" aria-expanded="true" onClick={() => handleSortDropDown()}>{handleSortText()}</span>
                            <ul className={sortDropDownOpened ? "sort-list dropdown-menu show" : "sort-list dropdown-menu "} >
                                <li onClick={(e) => handleSelectSortDropDown(e, 'priceasc')}><a href="#">{priceasc}</a></li>
                                <li onClick={(e) => handleSelectSortDropDown(e, 'pricedesc')}><a href="#">{pricedesc}</a></li>
                            </ul>
                        </div>
                        <ul className="layout-toggle nav nav-tabs">
                            <li className="nav-item">
                                <a className={layOut === 'grid' ? "layout-grid nav-link active" : "layout-grid nav-link "} data-toggle="tab" href="#layout-grid" role="tab" onClick={() => setLayout('grid')}><span className="icon-column"><span className="layer first"><span></span><span></span><span></span></span><span className="layer middle"><span></span><span></span><span></span></span><span className="layer last"><span></span><span></span><span></span></span></span></a>
                            </li>
                            <li className="nav-item">
                                <a className={layOut === 'list' ? "layout-list nav-link active" : "layout-list nav-link "} data-toggle="tab" href="#layout-list" role="tab" onClick={() => setLayout('list')}><span className="icon-column"><span className="layer first"><span></span><span></span></span><span className="layer middle"><span></span><span></span></span><span className="layer last"><span></span><span></span></span></span></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div className="tab-content">
                    {layOut === 'grid' &&
                        <div className="tab-pane fade show active" id="layout-grid" role="tabpanel">
                            <div className="products-list grid">
                                <div className="row" >
                                    {products.data && products.data.map((catpr) =>

                                        <div className="col-xl-4 col-lg-4 col-md-4 col-6" key={catpr.id}>
                                            <Product pr={catpr} />
                                        </div>

                                    )}
                                </div>
                            </div>
                        </div>
                    }
                    {layOut === 'list' &&
                        <div className="tab-pane fade show active" id="layout-grid" role="tabpanel">
                            <div className="products-list list">
                                {products.data && products.data.map((catpr) =>

                                    <ProductList pr={catpr} key={catpr.id}/>


                                )}
                            </div>
                        </div>
                    }
                </div>

                {products.per_page < products.data.length && 
                <nav className="pagination">
                    <ul className="page-numbers">
                        <li><a className="prev page-numbers" href="#" onClick={() => handlePageChange(currentPage - 1)} disabled={currentPage === 1}>Previous</a></li>
                        {[...Array(lastPage).keys()].map((page) => (
                            <li key={page + 1}

                            >
                                {currentPage === page + 1 ?
                                    <span aria-current="page" className="page-numbers current">{page + 1}</span>
                                    :
                                    <a className="page-numbers" href="#2" onClick={() => handlePageChange(page + 1)}>{page + 1}</a>

                                }

                            </li>
                        ))}
                        <li><a className="next page-numbers" href="#" onClick={() => handlePageChange(currentPage + 1)} disabled={currentPage === lastPage}>Next</a></li>
                    </ul>
                </nav>
            }
            </div>
        </>
    )
}

export default CatProducts
