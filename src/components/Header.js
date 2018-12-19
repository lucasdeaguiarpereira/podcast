import React, {Component} from 'react';
import Menu from './Header/Menu';

class Header extends Component{
    render(){
        const navLinks = this.props.navLinks;
        const title = this.props.title;
        const style = {
            padding:'15px 15px 0px 15px'
        }

        return(
            <header>
                
                <h1>{title}</h1>
                <Menu />
            </header>
        );
    }
}

export default Header;