import React, {Component} from 'react';

class AudioPlayer extends Component {
    constructor(){
        super();

        // if(this.props.src != "" && this.props.src != undefined){
        //     this.audio = new Audio(this.props.src);
        // }

        // this.ontimeupdate = this.update.bind(this);
            
        // this.onloadedmetadata = this.initValues.bind(this);
    }

    render(){
        return(
            <div className="audio-player">
                <div className="icon-play play-pause mr10"></div>
                
                <div className="current-time pt5 mr10">00:00</div>

                <progress value="0" className="time-slider mr10" max="20.636735"></progress>
            
                <div className="duration pt5 mr10">00:20</div>
            
                <div className="icon-volume-high volume-btn mr10"></div>
            
                <input className="slider volume-slider" type="range" min="0" max="100" value="100" />
            </div>
        );
    }
}

export default AudioPlayer;