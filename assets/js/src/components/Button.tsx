import * as React from "react";

export interface Props {
    title: string;
    disabled?: boolean;
    onPress(): void;
}

export default class Button extends React.Component<Props> {
    public render() {
        return (
            <button
                type="button"
                className="btn btn-secondary btn-lg"
                disabled={this.props.disabled}
                onClick={() => this.props.onPress()}
            >
                {this.props.title}
            </button>
        );
    }
}