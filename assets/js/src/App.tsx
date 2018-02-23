import * as React from "react";
import Form from "./components/Form";
import SearchService from "./services/SearchService";

export interface Product {
    name: string;
    image: string;
    price: string;
    url: string;
    shop: string;
}

export interface AppStates {
    products: Product[]
}

export default class App extends React.Component<{}, AppStates> {
    constructor(props) {
        super(props);

        this.state = {
            products: [],
        };
    }

    private handleOnPress(keyword: string) {
        //TODO: call search service?
        alert(keyword)
    }

    public render() {
        return (
            <div>
                <Form
                    onPress={(keyword) => this.handleOnPress(keyword)}
                />
            </div>
        );
    }
}