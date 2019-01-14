import React from 'react';
import Header from '../components/Header';
import Footer from '../components/Footer';
import Home from '../components/Home';
import Podcasts from '../components/Podcasts';
import Triangle from '../components/Triangle';
import AudioPlayer from '../components/AudioPlayer';
import { Switch, Route } from 'react-router-dom'

const Layout = (props) => {
    
    const links = [
        {name:'Home',url:'/'},
        {name:'Podcasts',url:'/podcasts'},
    ];

    const blueStyle = {
        borderBottom : "300px solid #698AF7",
        borderRight : "320px solid transparent"
    }

    return(
        <div className='container'>
            <Triangle stl={blueStyle} class={"triangle-blue"}/>
            {/* <Triangle class={"triangle-black"}/> */}

            <Header title='Podcast do Pereirinha' links={links}/>

            <Switch>
                <Route path="/" exact={true} component={Home} />
                <Route path="/podcasts" component={Podcasts} />
                <Route path="*" component={Home}/>
            </Switch>
                
            <AudioPlayer />

            <Footer />
        </div>
    );
}

export default Layout;