import React, {Component} from 'react';
import NavLink from './NavLink';



class Nav extends Component{
    constructor(){
        super();
    }

    render(){
        this.links = this.props.links;
        
        return(
            <nav>
                {this.links.map((obj, i)=><NavLink key={i} name={obj.name} url={obj.url}/>)}
            </nav>            
        );
    }
}

export default Nav;