import React from 'react';

import Skeleton from 'react-loading-skeleton';
import "react-loading-skeleton/dist/skeleton.css";
const CategoryProductSceleton = () => {
    return (
        <>
        <div className='row'>

        <div className="col-xl-4 col-lg-4 col-md-4 col-sm-6">
            
           <Skeleton height={200} width={'100%'} />
           <Skeleton height={10} width={'20%'} />
           <Skeleton height={10} width={'10%'} />
        </div>
        <div className="col-xl-4 col-lg-4 col-md-4 col-sm-6">
            
            <Skeleton height={200} width={'100%'} />
            <Skeleton height={10} width={'20%'} />
            <Skeleton height={10} width={'10%'} />
         </div>
         <div className="col-xl-4 col-lg-4 col-md-4 col-sm-6">
            
           <Skeleton height={200} width={'100%'} />
           <Skeleton height={10} width={'20%'} />
           <Skeleton height={10} width={'10%'} />
        </div>
        </div>

        </>
    )
}

export default CategoryProductSceleton