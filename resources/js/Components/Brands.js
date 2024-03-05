import React, { useEffect, useState  } from 'react';
import Axios from 'axios';

 const Brands = (props) => {
    const [brands , setBrands] = useState('')
    const [loading , setLoading] = useState(true)
    useEffect(() => {
        Axios.get('/api/brands').then(
            response => {
                setBrands( response.data.brands)
              setLoading(false)
            }
          )
        setLoading(false)
    
      }, []);
     // console.log(brands)
    // Your component code goes here
if(loading){
    return <p>Loading ...</p>
}
    return (
        <>
        <section className="section section-lg bg-200 text-center novi-background" data-preset="{&quot;title&quot;:&quot;Statistics&quot;,&quot;category&quot;:&quot;infographics&quot;,&quot;reload&quot;:true,&quot;id&quot;:&quot;statistics&quot;}">
        <div className="container">
          <h3 data-animate="{&quot;class&quot;:&quot;fadeInUp&quot;}" className="animated fadeInUp">Our Brands</h3>
          <div className="row row-30 justify-content-center justify-content-xl-between">
      {  brands &&  brands.map((brand)=>
            <div key={brand.id} className="col-xs-6 col-md-4 animated fadeInUp" data-animate="{&quot;class&quot;:&quot;fadeInUp&quot;}">
                
                <a className="navbar-navigation-megamenu-link" href={'/brand/' + brand.slug}>
                <img className="lazy-img" src={ "/storage/"+ brand.logo  } data-src={ "/storage/"+ brand.logo  } alt="" width="180" height="49" />
                </a>
            </div>
    )}
            
        
          </div>
        </div>
      </section>
        </>
    );
};

export default Brands;

