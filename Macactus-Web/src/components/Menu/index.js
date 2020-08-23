import React from 'react';
import './style.css';
import Draggable from 'react-draggable';


import profile from '../../assets/images/Sr Gregório.jpg'

class Menu extends React.Component{
    super(props){};
    state = {
        open: false,
        defP:{x:0, y: 400},
        deltaPosition: {
          x: 0, y: 0
        },
        controlledPosition: {
          x: -400, y: 200
        }
      };

      handleDrag = (e, ui) => {
        const {x, y} = this.state.deltaPosition;
        this.setState({
          deltaPosition: {
            y: y + ui.deltaY,
          }
        });
      };
    onStart = ()=>{

    }

    onStop = (e,ui)=>{
      if (this.state.open){
        if (this.state.deltaPosition.y<=-200){
          this.setState({
            open:true,
            defP:{x:0, y: 150},
            deltaPosition: {
              x: 0, y: -250
            }
          });
        }else{
            this.setState({
              open:false,
              defP:{x:0, y: 400},
              deltaPosition: {
                x: ui.deltaX, y: ui.deltaY
              }
           });
          }
      }else{
        if (this.state.deltaPosition.y<=-50){
          this.setState({
            open:true,
            defP:{x:0, y: 150},
            deltaPosition: {
              x: 0, y: -250
            }
          });
        }else{
            this.setState({
              open:false,
              defP:{x:0, y: 400},
              deltaPosition: {
                x: ui.deltaX, y: ui.deltaY
              }
           });
          }
      }
      
    };
    render() {
        const vw = window.innerWidth;
        const vh =  window.innerWidth;;
        const menuBounds = {top:150, bottom:400};
        const dragHandlers = {onStart: this.onStart, onStop: this.onStop, onDrag:this.handleDrag};
        return(             
        <Draggable axis="y"  position={this.state.defP} bounds={menuBounds} handle="#menu-bar" {...dragHandlers}>
        <div className="menu"  id="menu" ref="menu">
            <div className="center">
            <div id="menu-bar"></div>
            </div>
       
            <div className="menu-header">
              <h2>Menu</h2>
              
              <p className="more">Ver mais</p>
            </div>
            <div id="menu-items">
            <div className="menu-item">
                <img src="https://lh3.googleusercontent.com/proxy/3HlAPnBPbiR3wBn8ZHUB55MB1AI-H2Gtt2PJl-ue1FkC9_562igj6pxLboCDNkxg_1FhYiJT0XcFPqQ9vZxEFBsHfdjppbkqFg"
                className="class-icon"/>
                <p>Turmas</p>
            </div>
            <div className="menu-item">
                <img src="https://st.depositphotos.com/1000749/4285/v/450/depositphotos_42853807-stock-illustration-computer-video-game-controller-joystick.jpg"
                className="class-icon"/>
                <p>Jogos</p>
            </div>
            <div className="menu-item">
                <img src={profile}
                className="class-icon"/>
                <p>Perfil</p>
            </div>
            </div>
            </div>

        </Draggable>
        )};
}
//document.getElementById("menu-bar"))}
export default Menu;