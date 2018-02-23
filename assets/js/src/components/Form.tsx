import * as React from "react";

export interface FormProps {
    onPress(value: string): void;
}

export interface FormStates {
    value: string;
}

export default class Form extends React.Component<FormProps, FormStates> {
    constructor(props: FormProps) {
        super(props);

        this.state = {
            value: ''
        };
    }

    private handleChange(event) {
        this.setState({
            value: event.target.value
        });
    }

    public handleOnPress() {
        this.props.onPress(this.state.value);
    }

    public render() {
        return (
            <form className="form-inline">
                <input
                    type="text"
                    className="form-control"
                    placeholder="Jane Doe"
                    onChange={(e) => this.handleChange(e)}
                />

                <button type="button" className="btn btn-primary mb-2" onClick={() => this.handleOnPress()}>
                    Submit
                </button>
            </form>
        );
    }
}