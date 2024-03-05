import React from 'react';

import Skeleton from 'react-loading-skeleton';
const CheckOutSkeleton = () => {
    return (
        <>
            <div className="row">
  <div className="col-md-8">
    <div className="card">
      <header className="card-header">
        <h4 className="card-title mt-2">Loading please wait .....</h4>
      </header>
      <article className="card-body">
        <div className="form-row">
          <div className="col-6  form-group ">
            <label>Fisrt name * </label>
           <Skeleton  width={'100%'} height={60} />
          </div>
          <div className="col-6 form-group">
            <label>Last name * </label>
            <Skeleton  width={'100%'} height={60} />
          </div>
          <div className="col-6 form-group ">
            <label>Phone Number *</label>
            <Skeleton  width={'100%'} height={60} />
          </div>
          <div className="col-6 form-group">
            <label>Email Address</label>
            <Skeleton  width={'100%'} height={60} />
          </div>
        </div>
        <div className="form-group city">
            
          <label>City *</label>
        <Skeleton  width={'100%'} height={60} />
        </div>
        <div className="form-group">
          <label>Address *</label>
          <Skeleton  width={'100%'} height={60} />
        </div>
        <div className="form-group">
          <label>Order Notes</label>
          <Skeleton  width={'100%'} height={200} />
        </div>
      </article>
    </div>
  </div>
  <div className="col-md-4">
    <h3 className="mb-3">Totals </h3>
    <div className="table table-cart-total">
     
       
          <p >Subtotal:</p>
          <Skeleton  width={'50%'} height={30} />
        
          <p>Shipping:</p>
          <Skeleton  width={'50%'} height={30} />
       
          <p>Other Fees:</p>
          <Skeleton  width={'50%'} height={30} />
       
      <div>
          <p>Total:</p>
       
          <Skeleton  width={'50%'} height={30} />
          
      </div>
    </div>
    <hr />
    <h3 className="mb-4">Payment method </h3>
    <div className="col-12">
      <ul className="list list-lg">
        <li className="list-item">
          <div className="custom-control custom-radio">
          <Skeleton  width={'100%'} height={30} />
          
          </div>
        </li>
        <li className="list-item">
          <div className="custom-control custom-radio">
          <Skeleton  width={'100%'} height={30} />
          </div>
        </li>
      </ul>
    </div>
    <div className="col-md-12 mt-4">
    <Skeleton  width={'50%'} height={60} />
    </div>
  </div>
</div>

        </>
    )
}

export default CheckOutSkeleton