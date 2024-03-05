import React from 'react';

import Skeleton from 'react-loading-skeleton';
const SiteCartSceleton = () => {
    return (
        <>
               <tr className='cart-item'>

                        
                        <td className='product-thumbnail'>
                            <a className="table-cart-figure">
                           <Skeleton height={80} width={80} />
                          
                           </a>
                           <div className="product-name">
                           <Skeleton height={10} width={200} />								
                        </div>
                           </td>
                        
                        <td style={{ minWidth: '80px', width: '12.6%' }}>
                            <Skeleton height={24} width={60} /> </td>

                        <td style={{ minWidth: '120px', width: '14.3%' }}>
                            
                            <span className="ui-spinner ui-corner-all ui-widget ui-widget-content">
                               <Skeleton height={43} width={60} />
                            </span>
                        </td>

                        <td className="text-right" style={{ minWidth: 60, width: '9.8%' }}>
                            <Skeleton height={20} width={60} />
                        </td>

                    </tr>

        </>
    )
}

export default SiteCartSceleton