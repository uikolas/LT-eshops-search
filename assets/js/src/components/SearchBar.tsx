import * as React from "react";
import Card from "./Card";
import Button from "./Button";

export interface Props {
    onPress(value: string): void;
    disabled?: boolean;
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

    private handleFormSubmit(event) {
        event.preventDefault();
    }

    public handleOnPress() {
        this.props.onPress(this.state.value);
    }

    public render() {
        const disabled = this.props.disabled || (this.state.value ? false : true);

        return (
            <Card>
                <form id="search" onSubmit={(e) => this.handleFormSubmit(e)}>
                    <div className="row">
                        <div className="col-1">
                            <div className="text-secondary icon">
                                <i className="fas fa-search"></i>
                            </div>
                        </div>

                        <div className="col-9">
                            <input
                                type="text"
                                className="form-control form-control-lg"
                                placeholder="Keyword"
                                onChange={(e) => this.handleChange(e)}
                            />
                        </div>

                        <div className="col-2">
                            <Button
                                title="Search"
                                disabled={disabled}
                                onPress={() => this.handleOnPress()}
                            />
                        </div>
                    </div>
                </form>
            </Card>
        );
    }
}