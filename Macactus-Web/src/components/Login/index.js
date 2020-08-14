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
                <label>
                    Usuário(e-mail):
                    <input type="text" name="username" value={this.state.username} onChange={this.handleInputChange} />
                </label>
                <label>
                    Senha:
                    <input type="text" name="keyword" value={this.state.keyword} onChange={this.handleInputChange} />
                </label>
                <input type="submit" value="Entrar" />
            </form>
        );
    }
}

export default Login;