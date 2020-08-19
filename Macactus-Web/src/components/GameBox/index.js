import React from 'react';
import './style.css';

function GameBox(){
    return(
        <div className="game-container">
            <img src="https://images.habbo.com/habbo-web/america/pt/assets/images/app_summary_image-1200x628.85a9f5dc.png"
            className="game-image"/>
            <div className="box-content">
                <span className="class">212 a 314</span>
                <h3>Habbo</h3>
                <span className="materia" id="subject">Português</span>
            </div>
        </div>
    );
}

export default GameBox;