import React, { createContext, useState, useEffect } from "react";
import logoutIcon from "../../../assets/img/icons/log-out.svg";
import profileImg from "../../../assets/img/profiles/avator1.jpg";
import Sidebar from "./Sidebar/Sidebar";
import { Link, useForm, usePage } from "@inertiajs/react";
import { ToastContainer,toast } from "react-toastify";

export const ThemeContext = createContext();
function AppLayouts({ children }) {
    const { flash } = usePage().props;

    const [openSidebar, setOpenSidebar] = useState(false);
    const [openHeaderDropDown, setOpenHeaderDropDown] = useState(false);
    const [openUserMobileMenu, setOpenUserMobileMenu] = useState(false);

    const { post, processing } = useForm();

    const { auth, setting } = usePage().props;

    const handleLogout = (e) => {
        e.preventDefault();
        post(route("logout"));
    };

    const handleResize = () => {
        window.innerWidth > 575 && setOpenUserMobileMenu(false);
    };
    useEffect(() => {
        window.addEventListener("resize", handleResize);
        return () => {
            window.removeEventListener("resize", handleResize);
        };
    }, []);

    useEffect(() => {
        flash.success && toast.success(flash.success);
        flash.danger && toast.error(flash.danger);
    }, [flash]);

    return (
        <ThemeContext.Provider
            value={{
                openSidebar,
                setOpenSidebar,
                openHeaderDropDown,
                setOpenHeaderDropDown,
                openUserMobileMenu,
                setOpenUserMobileMenu,
            }}
        >
            <div
                className={
                    openSidebar ? "main-wrapper slide-nav" : "main-wrapper"
                }
                // onClick={() => {
                //     if (openHeaderDropDown) {
                //         setOpenHeaderDropDown(false);
                //     }

                //     if (openUserMobileMenu) {
                //         setOpenUserMobileMenu(false);
                //     }
                // }}
            >
                <div className="header">
                    <div className="header-left active">
                        <Link href={route('dashboard')} className="logo">
                            <img src={setting.logo} alt="" />
                        </Link>
                    </div>

                    <a
                        id="mobile_btn"
                        className="mobile_btn"
                        onClick={() => setOpenSidebar(!openSidebar)}
                    >
                        {openSidebar ? (
                            <i className="fas fa-times"></i>
                        ) : (
                            <i className="fas fa-bars"></i>
                        )}
                    </a>

                    <ul className="nav user-menu">
                        <li className="nav-item dropdown has-arrow main-drop">
                            <a
                                href="#"
                                className={
                                    openHeaderDropDown
                                        ? "dropdown-toggle nav-link userset show"
                                        : "dropdown-toggle nav-link userset"
                                }
                                data-bs-toggle="dropdown"
                                onClick={() =>
                                    setOpenHeaderDropDown(!openHeaderDropDown)
                                }
                            >
                                <span className="user-img">
                                    <img src={profileImg} alt="" />
                                    <span className="status online"></span>
                                </span>
                            </a>
                            <div
                                className={
                                    openHeaderDropDown
                                        ? "dropdown-menu menu-drop-user dropdownHeaderMenu show"
                                        : "dropdown-menu menu-drop-user"
                                }
                            >
                                <div className="profilename">
                                    <div className="profileset">
                                        <span className="user-img">
                                            <img src={profileImg} alt="" />
                                            <span className="status online"></span>
                                        </span>
                                        <div className="profilesets">
                                            <h6>{auth.user.name}</h6>
                                            <h5>{auth.user.name}</h5>
                                        </div>
                                    </div>
                                    <hr className="m-0" />
                                    {/* <a
                                        className="dropdown-item"
                                        href="profile.html"
                                    >
                                        <i
                                            className="me-2"
                                            data-feather="user"
                                        ></i>{" "}
                                        My Profile
                                    </a>
                                    <a className="dropdown-item" href="#">
                                        <i
                                            className="me-2"
                                            data-feather="settings"
                                        ></i>
                                        Settings
                                    </a>
                                    <hr className="m-0" /> */}

                                    <Link
                                        as="button"
                                        onClick={handleLogout}
                                        className="dropdown-item logout pb-0"
                                    >
                                        <img
                                            src={logoutIcon}
                                            className="me-2"
                                            alt="img"
                                        />
                                        {processing ? "Loading.." : "Sign Out"}
                                    </Link>
                                </div>
                            </div>
                        </li>
                    </ul>

                    <div
                        className={
                            openUserMobileMenu
                                ? "dropdown mobile-user-menu show"
                                : "dropdown mobile-user-menu"
                        }
                    >
                        <a
                            className="nav-link dropdown-toggle"
                            onClick={() =>
                                setOpenUserMobileMenu(!openUserMobileMenu)
                            }
                        >
                            <i className="fa fa-ellipsis-v"></i>
                        </a>
                        <div
                            className={
                                openUserMobileMenu
                                    ? "dropdown-menu dropdown-menu-right mobileUserMenu show"
                                    : "dropdown-menu dropdown-menu-right"
                            }
                        >
                            <a className="dropdown-item" href="">
                                My Profile
                            </a>
                            <a className="dropdown-item" href="">
                                Settings
                            </a>
                            <Link
                                as="button"
                                onClick={handleLogout}
                                className="dropdown-item"
                                href=""
                            >
                                {processing ? "Loading.." : "Sign Out"}
                            </Link>
                        </div>
                    </div>
                </div>

                {/* sidebar::begin */}
                <Sidebar />
                {/* sidebar::end */}
                <div className="page-wrapper">
                    <div className="content">{children}</div>
                </div>
            </div>
            <div
                className={
                    openSidebar ? "sidebar-overlay opened" : "sidebar-overlay"
                }
                onClick={() => setOpenSidebar(!openSidebar)}
            ></div>
            <ToastContainer />
        </ThemeContext.Provider>
    );
}

export default AppLayouts;
