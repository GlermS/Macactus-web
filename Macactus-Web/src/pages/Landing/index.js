import React from 'react';
import Login from '../../components/Login';

import Logo from '../../assets/images/macactus_logo_final.png'

import './style.css'

function Landing() {
  return (
      <div className="login">
         
          <div className="logo-box">
              <div className="center">
              <img src={Logo} id="logo" />
              </div>
          </div>

          <div className="center">
          <div className="login-box">
              <Login />
              </div>
          </div>
           
          <div className="center">
              <div className="register">
                  <p>Ainda não tem uma conta?</p>
                  <a href="https://macactus.top/">Criar uma conta</a>
              </div>
          </div>

          <footer>
              <div className="center">
                  <p>Macactus International Ltda.</p>
                </div>
        </footer>
      </div>
      
  );
}

export default Landing;
