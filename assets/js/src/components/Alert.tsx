import * as React from "react";

export interface Props {
    text: string;
}

export default class Alert extends React.Component<Props> {
    public render() {
        return (
            <div className="alert alert-danger mt-2" role="alert">
                {this.props.text}
            </div>
        );
    }
}