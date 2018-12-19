import React, {Component} from 'react';
import { Link } from 'react-router-dom'

class NavLink extends Component{
    constructor(){
        super();
    }

    render(){        
        this.url = this.props.url;

        this.name = this.props.name;
        let classes = ["nav-link"];

        if(window.location.pathname === this.url){
            classes.push("active");
        }
        
        return(
            <Link active='true' className={classes.join(" ")} to={this.url}>{this.name}</Link>
        );
    }
}

export default NavLink;