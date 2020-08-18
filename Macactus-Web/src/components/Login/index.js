import React, { Component } from 'react';
import './style.css';
import api from '../../services/api.js';

class Login extends Component {
    constructor(props) {
        super(props);
        this.state = {
            username: "",
            keyword: "",
            app: false
        };

        this.handleInputChange = this.handleInputChange.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
    }

    handleInputChange(event) {
        const target = event.target;
        const value = target.value;
        const name = target.name;

        this.setState({
            [name]: value
        });
    }

    handleSubmit(event) {
        console.log(this.state.username);
        event.preventDefault();
        api.post('/connection', {email:this.state.username, keyword: this.state.keyword})
            .then(response => {
                console.log(response.data.total)
            })
            .catch(error => this.setState({ error: error.message }));
    }

    render() {
        return (
            
                <form onSubmit={this.handleSubmit}>
                <div className="user-inputs">
                        <label>
                            <p>Usuário(e-mail):<br /></p>
                    <input type="text" name="username" value={this.state.username} onChange={this.handleInputChange} />
                </label>
                <label>
                        <p>Senha:<br /></p>
                    <input type="text" name="keyword" value={this.state.keyword} onChange={this.handleInputChange} />
                        </label>
                </div>  
                <div className="form-button">
                        <input type="submit" value="Entrar" />
                    </div>
                </form>
        );
    }
}

export default Login;