import axios from './common/axios-config'
import React, { useState } from 'react'
import { useDispatch, useSelector } from 'react-redux';
import { setUser } from './store/userSlice';
import Activity from './common/Activity';

const LoginHeader = ({ authenticated }) => {
    console.log(authenticated)
    const [loginModalOpened, setLoginModalOpened] = useState(false)
    const [password, setPassword] = useState('')
    const [email, setEmail] = useState('')
    const [loading, setLoading] = useState(false)
    const [authError, setAuthError] = useState('')
    const user = useSelector((state) => state.user.user);

    //translations
    const {login , emailtrans , passwordtrans , remember , forgotpassword , register , profile , local} = headings
    const dispatch = useDispatch();

    const handleEmailChange = (event) => {
        setEmail(event.target.value);
    };

    const handlePasswordChange = (event) => {
        setPassword(event.target.value);
    };
    const handleLogin = async (e) => {
        e.preventDefault();
        setLoading(true)
        try {
            const response = await axios.post('/api/login', { email, password });
            const token = response.data.token;
            console.log(response.data)
            dispatch(setUser(response.data))
            location.reload();
            // Store the token (in a cookie, localStorage, or state)
            // Redirect or perform any additional actions
        } catch (error) {
            // Handle login failure
            setAuthError(error.message)
            console.log('auth', error)
        }
        setLoading(false)
    };


    return (
        <>
        <div className="login-header">
            {authenticated == 'yes' ?
                <a className="active-login" href={"/profile/"+ local} > {profile}</a>
                :
                <>
                    <a className="active-login" href="#" onClick={() => setLoginModalOpened(true)}>{login}</a>
                    <div className={loginModalOpened ? 'form-login-register active' : "form-login-register"} >
                        <div className="box-form-login">
                            <div className="active-login" onClick={() => setLoginModalOpened(false)}></div>
                            <div className="box-content">
                                <div className="form-login active">
                                    <form className="login" onSubmit={(e) => handleLogin(e)} action="#f">
                                        <h2>{login}</h2>
                                        <p className="status"></p>
                                        <div className="content">
                                            <div className="username">
                                                <input
                                                    onChange={(event) => handleEmailChange(event)} value={email}
                                                    type="text" required="required" className={authError != '' ? "input-text is-invalid" : "input-text"} name="email" id="username" placeholder={emailtrans} />
                                                {authError &&
                                                    <span className="invalid-feedback" role="alert">
                                                        <strong>{authError}</strong>
                                                    </span>
                                                }
                                            </div>
                                            <div className="password">
                                                <input
                                                    onChange={(event) => handlePasswordChange(event)}
                                                    className={authError != '' ? "input-text is-invalid" : "input-text"} required="required" value={password} type="password" name="password" id="password" placeholder={passwordtrans} />
                                                {authError &&
                                                    <span className="invalid-feedback" role="alert">
                                                        <strong>{authError}</strong>
                                                    </span>
                                                }
                                            </div>
                                            <div className="rememberme-lost">
                                                <div className="rememberme">
                                                    <input name="rememberme" type="checkbox" id="rememberme" value="forever" />
                                                    <label htmlFor="rememberme" className="inline">{remember}</label>
                                                </div>
                                                <div className="lost_password">
                                                    <a href="/password/reset">{forgotpassword}?</a>
                                                </div>
                                            </div>
                                            <div className="button-login">
                                                {loading && 
                                                <Activity type="spinner" size={10} />}
                                                <input type='submit' className="button" name="login" value={login} disabled={loading} />
                                            </div>
                                            <div className="button-next-reregister" onClick={()=> window.location.assign("/register")}>{register}</div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </>
            }
            </div>
        </>
    )
}
export default LoginHeader