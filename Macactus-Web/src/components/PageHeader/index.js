import React from 'react';
import profile from '../../assets/images/Sr Gregório.jpg'

import './style.css';

function PageHeader(){
    return (
            <header className="page-header">
                <div className="top-bar-container">
                    <h2 className="page-name">Página Inicial</h2>  
                    <img src={profile} id="profile-image"/>
                </div>
            </header>
        );
}

export default PageHeader;