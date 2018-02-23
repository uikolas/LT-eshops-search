import React from "react";

export default class Form extends React.Component{
    constructor(props) {
        super(props);

        this.state = {
            value: ''
        };
    }

    _handleChange(event) {
        this.setState({
            value: event.target.value
        });
    }

    _handleOnPress() {
        this.props.onPress(this.state.value);
    }

    render() {
        return (
            <form className="form-inline">
                <input
                    type="text"
                    className="form-control"
                    placeholder="Jane Doe"
                    onChange={(e) => this._handleChange(e)}
                />

                <button type="button" className="btn btn-primary mb-2" onClick={() => this._handleOnPress()}>
                    Submit
                </button>
            </form>
        );
    }
}