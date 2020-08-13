import React, {useEffect, useState} from 'react';
import LogoImg from '../../assets/images/logo.svg'
import landingImg from '../../assets/images/landing.svg'
import {Link } from 'react-router-dom'

import studyIcon from '../../assets/images/icons/study.svg'
import giveClassesIcon from '../../assets/images/icons/give-classes.svg'
import purpleHeartIcon from '../../assets/images/icons/purple-heart.svg'



import "./styles.css"



function Landing() {
    return (
        < div id="page-landing" >
            <meta charset="utf-8"/>
            <div id="page-landing-content" className='container'>
                <div className="logo-container">
                    <img src={LogoImg} alt="Profy" />
                    <h2>Sua plataforma de estudos online.</h2>
                </div>

                <img
                    src={landingImg}
                    alt="Plataforma de estudos"
                    className="hero-image"
                />

                <div className="buttons-container">
                    <Link to="/study" className="study">
                        <img src={studyIcon} alt="Estudar" />
                        Estudar
                    </Link>

                    <Link to="/give-classes" className="give-classes">
                        <img src={giveClassesIcon} alt="Dar aula" />
                        Dar aulas
                    </Link>
                </div>
                <span className="total-connections">
                    Total de conex�es j� realizadas
                </span>
            </div>
        </div >
)
}

export default Landing;