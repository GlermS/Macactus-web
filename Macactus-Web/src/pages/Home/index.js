import React from 'react';

import PageHeader from '../../components/PageHeader';
import Menu from '../../components/Menu';
import GameBox from '../../components/GameBox';

import './style.css';



function Home(){
return (
    <div className="home">
        <PageHeader />
        <GameBox />
        <Menu />
    </div>
);
}

export default Home;