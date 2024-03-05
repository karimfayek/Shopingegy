
import React, { useEffect, useState } from 'react';
import { useDispatch, useSelector } from 'react-redux';
import Activity from './common/Activity';
import CheckOutSkeleton from './common/CheckOutSkeleton'
import { fetchCart } from './store/cartSlice';

const Checkout = () => {
    //customer info
    const [first_name, setFirstName] = useState('');
    const [last_name, setLastName] = useState('');
    const [loading, setLoading] = useState(false);
    const [phone, setPhone] = useState('');
    const [city, setCity] = useState('');
    const [address, setAddress] = useState('');
    const [email, setEmail] = useState('');
    const [message, setMessage] = useState('');
    const [errors, setErrors] = useState({});
    const [states, setStates] = useState([]);
    const [shippingval, setShippingVal] = useState(0);
    const [codFees, setCodFees] = useState(0);
    const [payModalOpened, setPayModalOpened] = useState(false)
    const [order, setOrder] = useState({});
    const [submited, setSubmited] = useState(false);
    const [selectedPayment, setSelectedPayment] = useState('');

    //payment    
    const [ccNo, setCcNo] = useState('4111111111111111');
    const [ccv, setCcv] = useState('123');
    const [expMonth, setExpMonth] = useState('12');
    const [expYear, setExpYear] = useState('27');
    const [paymentLoading, setPaymentLoading] = useState(false);
    const dispatch = useDispatch();
    //cart 
    const cart = useSelector((state) => state.cart.cart);
    const subTotal = useSelector((state) => state.cart.subTotal);
    const total = useSelector((state) => state.cart.total);

    //translation
    const {local ,firstname , lastname , placeorder , emailtrans , phonetrans , citytrans , companyname , addresstrans , ordernotes} = headings 
    useEffect(() => {
        // Include 2Checkout script
        const script = document.createElement('script');
        script.src = 'https://www.2checkout.com/checkout/api/2co.min.js';
        script.async = true;
        document.body.appendChild(script);

        script.onload = () => {
            // Initialize 2Checkout with Publishable Key
            window.TCO.loadPubKey('BCA0D390-78B5-4D3C-87DF-10E3E3FD050A');
        };

        return () => {
            document.body.removeChild(script);
        };
    }, []);

    const handlePayment = async (e) => {
        e.preventDefault()        
        setPaymentLoading(true)
        const tokenData = await getPaymentToken();

        // Step 2: Send the payment token to your Laravel backend
        const response = await sendTokenToBackend(tokenData);

        setPaymentLoading(false)
        // Step 3: Handle the backend response (you can redirect the user, show a confirmation, etc.)
        console.log(response);
    };

    const getPaymentToken = () => {
        
        setPaymentLoading(true)
        var args = {
            sellerId: "254863375785",
            publishableKey: "BCA0D390-78B5-4D3C-87DF-10E3E3FD050A",
            ccNo: ccNo,
            cvv: ccv,
            expMonth: expMonth,
            expYear: expYear
        };
        var successCallback = async (data) => {
            var myForm = document.getElementById('login_ajax');
            myForm.token.value = data.response.token.token;

            
            console.log("Token created successfully:", data);
            const backend = await sendTokenToBackend(data);
            console.log(backend)            
            setPaymentLoading(false) 
            if(backend.success) {
                setPayModalOpened(false)
                handleSubmit()
            } else{
                console.log('error in backend ',backend)
            }    
        }
        var errorCallback = (error) => {
            console.error("Error creating token:", error);            
            setPaymentLoading(false)
        }
            
        // This function uses the 2Checkout library to get the payment token
        return new Promise((resolve, reject) => {
            window.TCO.requestToken(successCallback, errorCallback, args);
        });
    };

    const sendTokenToBackend = async (tokenData) => {
        try {
            // Make a POST request to your Laravel backend with the payment token
            const response = await axios.post('/api/initiate-payment', {
                token: tokenData.response.token.token,
            });

            return response.data;
        } catch (error) {
            console.error('Error sending token to backend:', error);
            // Handle errors as needed
        }
    };
    useEffect(
        () => {
            setLoading(true)
            fetch(
                '/getstates', {
                method: 'GET',

            }
            ).then(response => response.json())
                .then(result => {
                    setStates(result.states)
                    setShippingVal(result.shipprice)
                    setCodFees(result.codFees)
                    console.log(result)
                    if (result.auth) {
                        setFirstName(result.user.first_name)
                        setLastName(result.user.last_name)
                        setPhone(result.user.phone)
                        setEmail(result.user.email)
                        setAddress(result.user.address)
                        setCity(result.user.city)
                        console.log(result.user)
                    }
                    setLoading(false)
                }
                )
                .catch(
                    error => console.log(error)
                )

        }, []
    )
    const HandleCityChange = (val) => {
        setCity(val);
        fetch(`/setshipping/${val}`, {
            method: 'GET',

        }
        ).then(
            response => response.json()
        ).then(result => {

            setShippingVal(result)
            dispatch(fetchCart());
            setLoading(false)
        }
        ).catch(
            error => console.log(error)
        )
    }
    const handlePaymentChange = (event) => {
        setSelectedPayment(event.target.value);
        console.log(event.target.value)
    };
    const handleSubmitOpenModal = (e) => {
        e.preventDefault
        setPayModalOpened(true);
    };
    const handleSubmit = () => {
        
        setLoading(true)
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        // Create a data object to send to Laravel
        const data = {
            first_name: first_name,
            last_name: last_name,
            phone: phone,
            city: city,
            address: address,
            message: message,
            email: email,
            selectedPayment: selectedPayment

        };

        console.log(JSON.stringify(data))
        // Send the data to Laravel Controller
        fetch('/store-order', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
            },
            body: JSON.stringify(data),
        })
            .then(response => response.json())
            .then(result => {
                // Handle the response from Laravel
                console.log(result)
                if (result.success) {
                    setSubmited(true)
                    setOrder(result.order)
                    dispatch(fetchCart())

                    setLoading(false)
                } else if (!result.success) {

                    setErrors(result.errors)
                    setLoading(false)
                } 
            })
            .catch(error => {
                // Handle errors
                console.error('Error:', error);
            });
    };

    const copyCart = { ...cart };
    const cartArray = Object.values(copyCart);
    if (loading) {
        return (
            <>
                <CheckOutSkeleton />

            </>
        )
    }
    if (cartArray.length < 1 ) {
        return (
            <>
             <p>Cart Empty</p>

            </>
        )
    }
    return (
        <>
            {payModalOpened &&
                <div className="form-login-register active">
                    <div className="box-form-login">
                        <div className="active-login" onClick={() => setPayModalOpened(false)}></div>
                        <div className="box-content">
                            <div className="form-login active">
                                <form id="login_ajax" className="login" onSubmit={(e) => handlePayment(e)}>
                                    <h2>Enter Card details</h2>
                                    <p className="status"></p>
                                    <input name="token" type="hidden" value="" />
                                    <div className="content row">
                                        <div className="username col-12">
                                            <label>Credit Card Number</label>
                                            <input defaultValue={ccNo} onChange={(e) => setCcNo(e.target.value)}
                                                type="number" required="required" className="input-text" id="ccNo" placeholder="Credit Card Number use 4111111111111111 for Test" />
                                        </div>
                                        <div className="username col-6">
                                            <label>Expiration Month</label>
                                            <input defaultValue={expMonth} onChange={(e) => setExpMonth(e.target.value)}
                                                className="input-text" required="required" type="number" id="expMonth" placeholder="exp Month use 12 for test" />
                                        </div>
                                        <div className="username col-6">
                                            <label>Expiration Year</label>
                                            <input defaultValue={expYear} onChange={(e) => setExpYear(e.target.value)}
                                                className="input-text" required="required" type="number" id="expYear" placeholder="exp Year use 27 for test" />
                                        </div>

                                        <div className="username col-6">
                                            <label>CVV</label>
                                            <input defaultValue={ccv} onChange={(e) => setCcv(e.target.value)}
                                                className="input-text" required="required" type="number" id="cvv" placeholder="cvv use 123 for test" />
                                        </div>
                                        <div className="button-login col-12">
                                            {paymentLoading &&
                                                <Activity type="spinner" size={10} />}
                                            <input type="submit" className="button" name="login" value={"Pay L.E " + total} disabled={paymentLoading} />
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            }
            {Object.keys(errors).length > 0 && (
                <div className="error-messages" style={{
                    position: 'fixed',
                    top: '19%',
                    background: '#f5caca',
                    padding: 13,
                    width: '50%',
                    zIndex: 9,
                    color: 'black',
                }}

                >
                    <p>Please fix the following errors:</p>
                    <ul>
                        {Object.keys(errors).map(field => (
                            errors[field].map((message, index) => (
                                <li key={index}>{message}</li>
                            ))
                        ))}
                    </ul>
                    <a style=
                        {{
                            position: 'absolute',
                            top: 0,
                            right: 16,
                            cursor: 'pointer'
                        }}
                        onClick={() => setErrors({})}
                    >X</a>
                </div>
            )}
            {submited ?

                <div className='text-center'>
                    <p>Thank you for your Order</p>
                    <p>Your Order Number is <b>{order.order_number} </b> </p>

                </div>


                :
                <>
                    <div name="checkout" className="checkout" >
                        <div className="row">
                            <div className= { "col-xl-8 col-lg-7 col-md-12 col-12" }>
                                <div className="customer-details">
                                    <div className="billing-fields">
                                        <h3>Billing details</h3>
                                        <div className="billing-fields-wrapper">
                                            <p className="form-row form-row-first validate-required">
                                                <label>{firstname} <span className="required" title="required">*</span></label>
                                                <span className="input-wrapper">
                                                    <input type="text" className="input-text" name="first_name" defaultValue={first_name} onChange={(e) => setFirstName(e.target.value)} autoComplete="given-name" /></span>
                                            </p>
                                            <p className="form-row form-row-last validate-required">
                                                <label>{lastname} <span className="required" title="required">*</span></label>
                                                <span className="input-wrapper"><input type="text" className="input-text" name="last_name" defaultValue={last_name} onChange={(e) => setLastName(e.target.value)} autoComplete="family-name" /></span>
                                            </p>
                                            <p className="form-row form-row-wide">
                                                <label>{companyname} <span className="optional">(optional)</span></label>
                                                <span className="input-wrapper"><input type="text" className="input-text" name="company" value="" autoComplete="organization" /></span>
                                            </p>

                                            <p className="form-row address-field validate-required form-row-wide">
                                                <label>{addresstrans} <span className="required" title="required">*</span></label>
                                                <span className="input-wrapper">
                                                    <input type="text" className="input-text" name="address" placeholder="House number and street name" defaultValue={address} onChange={(e) => setAddress(e.target.value)} />
                                                </span>
                                            </p>


                                            <p className="form-row address-field validate-required validate-state form-row-wide">
                                                <label>{citytrans}  <span className="required" title="required">*</span></label>
                                                <span className="input-wrapper">
                                                    <select name="city" className="state-select custom-select" defaultValue={city} onChange={(e) => HandleCityChange(e.target.value)} >
                                                        {
                                                            states.map(

                                                                (state) =>
                                                                (
                                                                    <React.Fragment key={state.id}>
                                                                        <option value={state.id}>{state.name}</option>

                                                                    </React.Fragment>
                                                                )
                                                            )
                                                        }
                                                    </select>
                                                </span>
                                            </p>

                                            <p className="form-row form-row-wide validate-required validate-phone">
                                                <label>{phonetrans} <span className="required" title="required">*</span></label>
                                                <span className="input-wrapper">
                                                    <input type="tel" className="input-text" name="phone" defaultValue={phone} onChange={(e) => setPhone(e.target.value)} autoComplete="tel" />
                                                </span>
                                            </p>
                                            <p className="form-row form-row-wide validate-required validate-email">
                                                <label>{emailtrans} <span className="required" title="required">*</span></label>
                                                <span className="input-wrapper">
                                                    <input type="email" className="input-text" name="email" defaultValue={email} onChange={(e) => setEmail(e.target.value)} autoComplete="email" />
                                                </span>
                                            </p>
                                        </div>
                                    </div>

                                </div>

                                <div className="additional-fields">
                                    <p className="form-row notes">
                                        <label>{ordernotes} <span className="optional">(optional)</span></label>
                                        <span className="input-wrapper">
                                            <textarea name="order_comments" className="input-text" placeholder="Notes about your order, e.g. special notes for delivery." rows="2" cols="5" onChange={(e) => setMessage(e.target.value)} value={message}></textarea>
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div className="col-xl-4 col-lg-5 col-md-12 col-12">
                                <div className="checkout-review-order">
                                    <div className="checkout-review-order-table">
                                        <div className="review-order-title">Product</div>
                                        <div className="cart-items">
                                            {cartArray && cartArray.map(
                                                (pro) => (
                                                    <div className="cart-item" key={pro.id}>
                                                        <div className="info-product">
                                                            <div className="product-thumbnail">
                                                                <img width="600" height="600" src={'/storage/products/mobile_photos/' + pro.attributes.image} alt="" />
                                                            </div>
                                                            <div className="product-name">
                                                                {pro.name}
                                                                <strong className="product-quantity">QTY : {pro.quantity}</strong>
                                                            </div>
                                                        </div>
                                                        <div className="product-total">
                                                            <span>L.E {pro.quantity * pro.price}</span>
                                                        </div>
                                                    </div>
                                                )
                                            )}


                                        </div>
                                        <div className="cart-subtotal">
                                            <h2>Subtotal</h2>
                                            <div className="subtotal-price">
                                                <span>L.E {subTotal}</span>
                                            </div>
                                        </div>
                                        <div className="shipping-totals shipping">
                                            <h2>Shipping</h2>
                                            <div data-title="Shipping">
                                                <ul className="shipping-methods custom-radio">
                                                    <li>
                                                        {shippingval ? 'L.E ' + shippingval : 'Select City to calcualte'}
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                        <div className="shipping-totals shipping">
                                            <h2>Other Fees</h2>
                                            <div data-title="Shipping">
                                                <ul className="shipping-methods custom-radio">
                                                    <li>
                                                        {selectedPayment === 'credit-card' || selectedPayment === ""
                                                            ? '0'
                                                            : codFees}
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                        <div className="order-total">
                                            <h2>Total</h2>
                                            <div className="total-price">
                                                <strong>
                                                    <span>L.E  {selectedPayment === "cash-on-delivery" ? parseFloat(total) + parseFloat(codFees) : total}</span>
                                                </strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="payment" className="checkout-payment">
                                        <ul className="payment-methods methods ">

                                            <li className="payment-method">
                                                <input id="cod" type="radio" className="input-radio" name="payment_method" defaultValue='cash-on-delivery' checked={selectedPayment === 'cash-on-delivery'} onChange={handlePaymentChange} />
                                                <label className='ml-2'>Cash on delivery  + {codFees} L.E</label>
                                                <div className="payment-box">
                                                    <p>Pay with cash upon delivery.</p>
                                                </div>
                                            </li>
                                            <li className="payment-method">
                                                <input id='cc' type="radio" className="input-radio" name="payment_method" defaultValue='credit-card' checked={selectedPayment === 'credit-card'} onChange={handlePaymentChange} />
                                                <label className='ml-2'>PayPal</label>
                                                <div className="payment-box">
                                                    <p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account.</p>
                                                </div>
                                            </li>
                                        </ul>
                                        <div className="form-row place-order">
                                            <div className="terms-and-conditions-wrapper">
                                                <div className="privacy-policy-text"></div>
                                            </div>
                                            <button
                                                onClick={(e) => handleSubmitOpenModal(e)}
                                                className="button alt" name="checkout_place_order" value={placeorder} disabled={!selectedPayment || loading} >
                                                {selectedPayment === 'credit-card'
                                                    ? 'Continue to Credit Card Payment'
                                                    : placeorder}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </>
            }
        </>
    )
}
export default Checkout