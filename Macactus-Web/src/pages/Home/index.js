import React from 'react';

import PageHeader from '../../components/PageHeader';
import Menu from '../../components/Menu';
import GameBox from '../../components/GameBox';
import './style.css';
import {Swiper, SwiperSlide} from 'swiper/react';
import SwiperCore, {EffectFade} from 'swiper';
import 'swiper/swiper-bundle.css';

SwiperCore.use(EffectFade);

function Home(){
    const Games = [

        (<SwiperSlide key={'1'}>
            <GameBox />
        </SwiperSlide>),
        (<SwiperSlide key={'2'}>
          <GameBox />
        </SwiperSlide>),
        (<SwiperSlide key={'3'}>
         <GameBox />
        </SwiperSlide>),
        (<SwiperSlide key={'4'}>
            <div />
       </SwiperSlide>)
    ];
return (
    <div className="home">
        <PageHeader />
        <Swiper id="games-slider" slidesPerView={2} spaceBetween={"33%"} in effectFade>
            {Games}
        </Swiper>
        <Menu />
    </div>
);
}

export default Home;