import Axios from 'axios';
import React, {  useEffect, useState } from 'react';

import Slider from "react-slick";
import Activity from './common/Activity';
import { sliderSettings } from './common/sliderSettings';



const HomeCats = (props) => {
  const [cats, setCats] = useState([])
  const [loading, setLoading] = useState(true)
  
  const [Pageload , setPageLoad ] = useState(false)
const {local} = headings


  useEffect(() => {
    //fetch Cats
    Axios.get('/api/homecats').then(
      response => {
        setCats(response.data.cats)
        console.log(response.data.cats)
      }
    )
    /////
    setLoading(false)

  }, []);
 
  useEffect(() => {
    if (Pageload) {
      const portalElement = document.createElement('div');
      portalElement.className = 'page-preloader';
      portalElement.innerHTML = `
        <div class="loader">
          <div></div>
          <div></div>
        </div>
      `;
      document.body.appendChild(portalElement);
      return () => {
        document.body.removeChild(portalElement);
        setPageLoad(false)
      };
    }
  }, [Pageload]);
  const handleMouseDown = (e) => {
    // Store the starting position of the mouse
    dragStartX.current = e.clientX;
    dragStartY.current = e.clientY;
    isDragging.current = false;
  };

  const handleMouseUp = (e) => {
    // Calculate the distance the mouse has moved
    const dx = Math.abs(dragStartX.current - e.clientX);
    const dy = Math.abs(dragStartY.current - e.clientY);

    // If the mouse has moved more than a certain amount, set isDragging to true
    if (dx > 5 || dy > 5) {
      isDragging.current = true;
    }
  };
  const handleMouseEnter = () => {
    setIsHovered(true);
  };

  const handleMouseLeave = () => {
    setIsHovered(false);
  };
  const handlePageLoad = (e) => {
    // If isDragging is true, prevent the default action and return
    if (isDragging.current) {
      e.preventDefault();
      return;
    }
    // Otherwise, proceed with the page load
    setPageload(true);
  };
  // component code 
  if(loading){
    return (
     <Activity type='levels' />
    )
}


  return (
    <>
       <Slider {...sliderSettings(cats)}>
      {cats.length > 0 && cats.map((cat) =>
        <div className="item item-product-cat slick-slide" key={cat.id}  onMouseEnter={handleMouseEnter} onMouseLeave={handleMouseLeave}>
          <div className="item-product-cat-content" onMouseDown={handleMouseDown}
           onMouseUp={handleMouseUp}>
            <a href={'/category/' + cat.slug  + '/' + local} onClick={(e) => handlePageLoad(e)} >
              <div className="item-image">
                <img width="258" height="258" src={'/storage/' + cat.image}  alt={cat.LocalName} />
              </div>
            </a>
            <div className="product-cat-content-info">
              <h2 className="item-title">
                <a href={'/category/' + cat.slug + '/' + local} onClick={(e) => handlePageLoad(e)} >{cat.LocalName}</a>
              </h2>
            </div>
          </div>
        </div>
      )}

</Slider>


    </>
  );
};

export default HomeCats;

