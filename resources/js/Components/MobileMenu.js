import Axios from 'axios';
import React, { useEffect, useState } from 'react'



const MobileMenu = () => {
    const [menuOpened, setMenuOpened] = useState(false)
    const [subMenuOpened, setSubMenuOpened] = useState("")
    const [subSubMenuOpened, setSubSubMenuOpened] = useState(null)
    const [cats, setCats] = useState([])
    const [selectedCat, setselectedCat] = useState([])
    const [loading, setLoading] = useState(true)
    const {local , home , about , products , contact}=headings
    useEffect(() => {
        if (subSubMenuOpened !== null) {
          setLoading(true);
          const result = cats.filter((cat) => cat.id === subSubMenuOpened);
          setselectedCat(result);
          setLoading(false);
        }
      }, [subSubMenuOpened, cats]);

    const handleSubMenu = (id) => {
        
        setSubSubMenuOpened(id)
       
    }
    useEffect(() => {
        setLoading(true)
        Axios.get(`/api/cats`).then(
            response => {
                setCats(response.data.categories)

            }
        )
        setLoading(false)


    }, []);
    return (
        <>
            <div className="navbar-header">
                <button type="button" id="show-megamenu" className="navbar-toggle" onClick={() => setMenuOpened(true)}></button>
            </div>
            <div className={menuOpened ? "site-mobile-navigation mm-wrapper active" : "site-mobile-navigation mm-wrapper"}>
                <span id="remove-megamenu" className="remove-megamenu icon-remove" onClick={() => setMenuOpened(false)}>Close</span>
                <nav id="mobile-main-menu" className="mm-menu">
                    <div className="mm-panels">
                        <div className="mm-panel mm-opened" id="mm-0">
                            <ul className="menu mm-listview">
                                <li className="level-0 menu-item current-menu-item ">
                                    <a href="/en"><span className="menu-item-text">{home}</span></a>
                                </li>
                                <li className="level-0 menu-item  ">
                                    <a href="/page/about/en"><span className="menu-item-text">{about}</span></a>
                                </li>
                                <li className="level-0 menu-item menu-item-has-children  ">
                                    <a className="mm-next" href="#mm-1" aria-owns="mm-1" onClick={() => setSubMenuOpened('pr')}></a>
                                    <a href="#"><span className="menu-item-text">{products}</span></a>
                                </li>
                                <li className="level-0 menu-item ">
                                    <a href="/contact/en"><span className="menu-item-text"> {contact}</span></a>
                                </li>
                                <li className="level-0 menu-item">
                                    {local === 'en' ? 
                                    <a href="ar"><span className="menu-item-text"><i className="fa fa-globe mr-2"></i>ع</span></a>
                                    :
                                    
                                    <a href="en"><span className="menu-item-text"><i className="fa fa-globe mr-2"></i>English</span></a>
                                    
                                }
                                </li>
                            </ul>
                        </div>
                        <div className={subMenuOpened == "pr" ? "mm-panel mm-hasnavbar mm-opened" : "mm-panel mm-hasnavbar mm-hidden"} id="mm-1" aria-hidden="true">
                            <div className="mm-navbar">
                                <a className="mm-btn mm-prev" href="#mm-0" onClick={() => setSubMenuOpened('')}>
                                    <span className="mm-sronly">Close submenu (Products)</span></a>
                                <a className="mm-title" href="#mm-0" aria-hidden="true">{products}</a>
                            </div>
                            <ul className="sub-menu mm-listview">
                                {cats.length > 0 && cats.map((cat) =>
                                    <li className={cat.children.length > 0 ? "level-1 menu-item menu-item-has-children" : "level-1 menu-item " } key={cat.id}>
                                        {cat.children.length > 0 &&
                                        <a className="mm-next" href="#mm-2"  onClick={() => handleSubMenu(cat.id) }></a>
                                        }
                                        <a href={"/category/"+cat.slug+ "/"+local}><span className="menu-item-text">{cat.LocalName}</span></a>
                                    </li>
                                )
                                }

                            </ul>
                        </div>
                        {subSubMenuOpened && !loading &&
                        <div className="mm-panel mm-opened mm-hasnavbar" id="mm-2" aria-hidden="true">
                            <div className="mm-navbar">
                                <a className="mm-btn mm-prev" href="#mm-1" onClick={() =>setSubSubMenuOpened(null) }>
                                <span className="mm-sronly">Close submenu ()</span></a>
                                <a className="mm-title" href="#mm-1" aria-hidden="true" onClick={() =>setSubSubMenuOpened(null) }> {selectedCat && selectedCat[0]?.LocalName}</a></div>
                            <ul className="sub-menu mm-listview">
                               {selectedCat[0]?.children.map((sCat)=>
                                <li>
                                    <a href={"/category/"+sCat.slug+'/'+local}><span className="menu-item-text">{sCat.LocalName}</span></a>
                                </li>
                               )}
                               
                            </ul>
                        </div>
                        }
                    </div>
                </nav>
            </div>
        </>
    )
}


export default MobileMenu