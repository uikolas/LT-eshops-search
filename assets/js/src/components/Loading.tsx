import * as React from "react";

export default class Loading extends React.Component<{}> {
    public render() {
        return (
            <div className="loader-container">
                <div className="loader">Loading...</div>
            </div>
        );
    }
}