import * as React from "react";

export interface Props {
    onPress(value: string): void;
}

export interface States {
    value: string;
}

export default class SearchBar extends React.Component<Props, States> {
    constructor(props: Props) {
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