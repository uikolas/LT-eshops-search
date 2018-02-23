import React from "react";
import Form from "./components/Form";

export default class App extends React.Component{
    _handleOnPress(keyword) {
        alert(keyword)
    }

    render() {
        return (
            <div>
                <Form
                    onPress={(keyword) => this._handleOnPress(keyword)}
                />
            </div>
        );
    }
}