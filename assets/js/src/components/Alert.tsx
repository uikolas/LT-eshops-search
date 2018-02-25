import * as React from "react";

export interface Props {
    text: string;
}

export default class Alert extends React.Component<Props> {
    public render() {
        return (
            <div className="alert alert-danger mt-2" role="alert">
                <strong>Error!</strong> {this.props.text}
            </div>
        );
    }
}