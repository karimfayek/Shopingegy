import React from 'react'

 const ProductImage = ({firstimage , lastimage , localname}) => {
    //console.log(firstimage)
  return (
    <>
    <img
            sizes="(max-width: 420px) 10w, (max-width: 768px) 60w, (max-width: 1024px) 420w, 600w"
            srcSet=
            {'/storage/products/tiny_photos/' + firstimage + ' 10w,' +
              '/storage/products/thumbnail/' + firstimage + ' 60w,' +
              '/storage/products/mobile_photos/' + firstimage + ' 420w,' +
              '/storage/products/medium_photos/' + firstimage + ' 600w'}

            src={'/storage/products/thumbnail/' + firstimage}
            className="post-image"
            alt={localname}
            width="600"
            height="600"
          />
          <img
            sizes="(max-width: 420px) 10w, (max-width: 768px) 60w, (max-width: 1024px) 420w, 600w"
            srcSet=
            {'/storage/products/tiny_photos/' + lastimage + ' 10w,' +
              '/storage/products/thumbnail/' + lastimage + ' 60w,' +
              '/storage/products/mobile_photos/' + lastimage + ' 420w,' +
              '/storage/products/medium_photos/' + lastimage + ' 600w'}

            src={'/storage/products/thumbnail/' + lastimage}
            className="hover-image back"
            alt={ localname }
            width="600"
            height="600"
          />
    </>
  )
}
export default ProductImage