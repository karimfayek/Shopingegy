export const sliderSettings = (products)=>{
  function NextArrow(props) {
    const { className, style, onClick } = props;
    return (
      <i
      className='slick-arrow fa fa-angle-right'
        style={{ ...style}}
        onClick={onClick}
      />
    );
  }
  
  function PrevArrow(props) {
    const { className, style, onClick } = props;
    return (
      <i
        className='slick-arrow fa fa-angle-left'
        style={{ ...style }}
        onClick={onClick}
      />
    );
  }
  
  return {
  
    dots: true,
    autoplay: false,
    arrows: true,
    slidesToShow: products.length > 3 ? 4 : products.length,
    slidesToScroll: products.length > 3 ? 4 : products.length,
    lazyLoad: true,
    pauseOnHover: true,
    centerPadding: "60px",
    nextArrow: <NextArrow />,
    prevArrow: <PrevArrow />,
    responsive: [
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2,
          initialSlide: 2,
          dots: false,
        },
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          dots: false,
          className: "center",
          centerMode: true,
          arrows:false,
        },
      },
    ],
  }
  };
  
  