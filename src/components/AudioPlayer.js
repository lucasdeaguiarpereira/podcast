import React, {Component} from 'react';

class AudioPlayer extends Component {
    constructor(){
        super();
        this.state = {
            volume:100,
            progress:0,
            duration:20
        }

        // if(this.props.src != "" && this.props.src != undefined){
        //     this.audio = new Audio(this.props.src);
        // }

        // this.ontimeupdate = this.update.bind(this);
            
        // this.onloadedmetadata = this.initValues.bind(this);
    
    }
    
    update(){
        this.timeSlider.setAttribute("value", this.currentTime);
        this.currentTimeProp.innerHTML = secondsToMSformat(this.currentTime);
        
        if(this.ended) this.resetPlayer();    
    }

    initValues(){
        this.timeSlider.setAttribute("max", this.duration);
        this.durationProp.innerHTML = secondsToMSformat(this.duration);
    }

    playPauseEvent(){
        if(this.isPlaying){
            this.pause();
            this.playPauseBtn.classList.remove('icon-pause');
            this.playPauseBtn.classList.add('icon-play');
        }else{
            this.play();
            this.playPauseBtn.classList.remove('icon-play');
            this.playPauseBtn.classList.add('icon-pause');
        }

        //toggle
        this.isPlaying = !this.isPlaying;
    }
    changeVolume(event){
        this.setState({volume:event.target.value});
        
    }

    changeProgress(event){
        let currentSliderWidth = event.target.offsetWidth;
        let xMouseClk = event.nativeEvent.offsetX;
        let percentage = xMouseClk / currentSliderWidth;
        let currentTime = this.state.duration * percentage;

        this.setState({progress:currentTime});
    }

    render(){
        return(
            <div className="audio-player">
                <div className="icon-play play-pause mr10"></div>
                
                <div className="current-time pt5 mr10">00:00</div>

                <progress value="0" className="time-slider mr10" max="20" value={this.state.progress} onClickCapture={this.changeProgress.bind(this)}></progress>
            
                <div className="duration pt5 mr10">00:20</div>
            
                <div className="icon-volume-high volume-btn mr10"></div>
            
                <input className="slider volume-slider" onChange={this.changeVolume.bind(this)} type="range" min="0" max="100" value={this.state.volume} />
            </div>
        );
    }
}

export default AudioPlayer;