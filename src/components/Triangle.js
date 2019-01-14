import React, {Component} from 'react';

class Triangule extends Component{
    constructor(){
        super();
        
        this.state = {
            style:{
                borderBottom : "300px solid #698AF7",
                borderRight : "320px solid transparent"
            }
        }
        let wWidth = window.innerWidth;
        let wHeight = window.innerHeight;

        this.state.style.borderBottom = this.changeBorderSize("300px solid #698AF7",3*wHeight/5);
        this.state.style.borderRight = this.changeBorderSize("320px solid transparent", 2*wWidth/3);
        
        window.onresize = () => {
            this.changeStyle();
        }
    }

    changeStyle(){
        let bBottom = this.state.style.borderBottom;
        let bRight = this.state.style.borderRight;
        
        let wWidth = window.innerWidth;
        let wHeight = window.innerHeight;

        bBottom = this.changeBorderSize(bBottom, 3*wHeight/5);
        bRight = this.changeBorderSize(bRight, 2*wWidth/3);
        
        this.setState({style:{borderBottom: bBottom, borderRight: bRight}});
    }

    changeBorderSize(border, value){
        border = Array.from(border.split(" "));
        border.shift();
        border.unshift(value+"px");
        border = border.join(" ");
        
        return border;
    }

    render(){
        return(
            <div className={this.props.class} style={this.state.style}></div>
        );
    }
}

export default Triangule;
