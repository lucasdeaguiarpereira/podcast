import React from 'react';
import ReactDOM from 'react-dom';
import Layout from './pages/Layout';
import './css/style.css';
import { BrowserRouter as Router } from 'react-router-dom'


const app = document.getElementById("app");

ReactDOM.render(
    <Router>
        <Layout />
    </Router>
, app);
