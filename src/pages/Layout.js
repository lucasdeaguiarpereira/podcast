import React, {Component} from 'react';
import Header from '../components/Header';
import Footer from '../components/Footer';
import Home from '../components/Home';
import Podcasts from '../components/Podcasts';
import { Switch, Route } from 'react-router-dom'

class Layout extends Component{
    
    render(){
        const navLinks = [
            {name:'Home',url:'/'},
            {name:'Podcasts',url:'/podcasts'},
        ];

        return(
            <div className='container'>
                <Header title='Podcast do Pereirinha' navLinks={navLinks}/>

                <Switch>
                    <Route path="/" exact={true} component={Home} />
                    <Route path="/podcasts" component={Podcasts} />
                    <Route path="*" component={Home}/>
                </Switch>
                
                <Footer />
            </div>
        );
    }
}

export default Layout;