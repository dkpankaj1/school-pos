import React,{useState} from "react";
import Logo from "../../../assets/img/logo.png";
import MailIcon from "../../../assets/img/icons/mail.svg";
import SideImage from "../../../assets/img/login.jpg";
import { useForm } from "@inertiajs/react";

function Login() {

  const [showPassword,setShowPassword] = useState(false);

    const { data, setData, post, processing, errors } = useForm({
        email: "",
        password: "",
    });

    const handleSubmit = () => {
        post("login");
    };

    return (
        <div className="account-page">
            <div className="main-wrapper">
                <div className="account-content">
                    <div className="login-wrapper">
                        <div className="login-content">
                            <div className="login-userset">
                                <div className="login-logo">
                                    <img src={Logo} alt="img" />
                                </div>
                                <div className="login-userheading">
                                    <h3>Sign In</h3>
                                    <h4>Please login to your account</h4>
                                </div>
                                <div className="form-login">
                                    <label>Email</label>
                                    <div className="form-addons">
                                        <input
                                            type="text"
                                            placeholder="Enter your email address"
                                            onChange={(e) =>
                                                setData("email", e.target.value)
                                            }
                                            value={data.email}
                                        />
                                        {errors.email && (
                                            <div
                                                id="login-username-error"
                                                className="invalid-feedback animated fadeIn d-block"
                                            >
                                                {errors.email}
                                            </div>
                                        )}
                                        <img src={MailIcon} alt="img" />
                                    </div>
                                </div>
                                <div className="form-login">
                                    <label>Password</label>
                                    <div className="pass-group">
                                        <input
                                            type={showPassword ? "text" : "password" }
                                            className="pass-input"
                                            placeholder="Enter your password"
                                            onChange={(e) =>
                                                setData(
                                                    "password",
                                                    e.target.value
                                                )
                                            }
                                            value={data.password}
                                        />
                                        {errors.password && (
                                            <div
                                                id="login-username-error"
                                                className="invalid-feedback animated fadeIn d-block"
                                            >
                                                {errors.password}
                                            </div>
                                        )}
                                        <span className="fas toggle-password fa-eye-slash" onClick={() => setShowPassword(!showPassword)}></span>
                                    </div>
                                </div>

                                <div className="form-login">
                                    <button
                                        className="btn btn-login"
                                        onClick={handleSubmit}
                                        disabled={processing}
                                    >
                                        {processing ? "Loading" : "Sign In"}
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div className="login-img">
                            <img src={SideImage} alt="img" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default Login;
