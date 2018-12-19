import React, {Component} from 'react';
import Menu from './Header/Menu';

class Header extends Component{
    constructor(){
        super();
    }
    
    render(){
        return(
            <header>
                <h1>{this.props.title}</h1>
                <Menu links={this.props.links} />
            </header>
        );
    }
}

export default Header;