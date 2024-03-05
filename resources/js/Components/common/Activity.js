import React from 'react'

import { Dots , Levels , Spinner } from "react-activity";

import "react-activity/dist/library.css";

const Activity = ({ type , size }) => {
    
    if (type === 'dots') {
        return (
            <div style={{ display: 'flex', flex: 1, alignItems: 'center', justifyContent: 'center' }}>

                <Dots color="#727981" size={size ? size : 32} speed={1} animating={true} />
            </div>
        )
    }
    if (type === 'levels') {
        
        return (
            <div style={{ display: 'flex', flex: 1, alignItems: 'center', justifyContent: 'center' }}>

                <Levels color="#727981" size={size ? size : 32} speed={1} animating={true} />
            </div>
        )
    }
    if (type === 'spinner') {
        return (
            <div style={{ display: 'flex', flex: 1, alignItems: 'center', justifyContent: 'center' }}>

                <Spinner color="#727981" size={size ? size : 32} speed={1} animating={true} />
            </div>
        )
    }
}
export default Activity